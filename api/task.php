<?php
header("Content-Type: application/json");
include("../config/connection.php");


$action = $_POST['action'];

function getTasks($conn)
{
    $data = array();
    $message = array();

    $sql = "SELECT * FROM tbltask";
    $result = $conn->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $message = array("status" => "true", "msg" => $data);
    } else {
        $message = array("status" => "false", "msg" => "Error fetching data");
    }
    echo json_encode($message);
}
function getTask($conn)
{
    $data = array();
    $message = array();
    $id = $_POST['id'];

    $sql = "SELECT * FROM tbltask WHERE id=$id";
    $result = $conn->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $message = array("status" => "true", "msg" => $data);
    } else {
        $message = array("status" => "false", "msg" => $conn->error);
    }
    echo json_encode($message);
}



// Register Users
function register($conn)
{
    extract($_POST);

    $message = array();

    $sqlQuery = "INSERT INTO `tbltask`(`title`,`desc`,`category`) VALUES ('$title','$desc','$cat')";
    $result = $conn->query($sqlQuery);

    if ($result) {
        $message = array("status" => true, "msg" => "Task Registered successfully");
    } else {
        $message = array("status" => false, "msg" => "Error adding Task");
    }
    echo json_encode($message);
}



// update users
function updateTask($conn)
{
    extract($_POST);

    $message = array();

    $sqlQuery = "UPDATE `tbltask` SET `title`='$title',`desc`='$desc',`category`='$cat' WHERE id=$id";
    $result = $conn->query($sqlQuery);

    if ($result) {
        $message = array("status" => "true", "msg" => "Task Updated successfully");
    } else {
        $message = array("status" => "false", "msg" => "Error Updating Task");
    }
    echo json_encode($message);
}




// delete single item
function deletTask($conn)
{
    $id = $_POST["id"];


    $message = array();

    $sqlQuery = "DELETE FROM tbltask WHERE id=$id";
    $result = $conn->query($sqlQuery);

    if ($result) {
        $message = array("status" => "true", "msg" => "Task Deleted successfully");
    } else {
        $message = array("status" => "false", "msg" => "Error Deleting Task");
    }
    echo json_encode($message);
}


// generate and finalize the Aciton

if (isset($action)) {
    $action($conn);
} else {
    echo "Error, Action is required, maadan soo baasin";
}
