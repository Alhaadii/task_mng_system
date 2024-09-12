<?php
header("Content-Type: application/json");
include("../config/connection.php");


$action = $_POST['action'];

function getCats($conn)
{
    $data = array();
    $message = array();

    $sql = "SELECT * FROM cats";
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
function getCat($conn)
{
    $data = array();
    $message = array();
    $id = $_POST['id'];

    $sql = "SELECT * FROM cats WHERE id=$id";
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

    $sqlQuery = "INSERT INTO `cats`(`cat_name`) VALUES ('$cat')";
    $result = $conn->query($sqlQuery);

    if ($result) {
        $message = array("status" => true, "msg" => "category Registered successfully");
    } else {
        $message = array("status" => false, "msg" => "Error adding category");
    }
    echo json_encode($message);
}



// update users
function updateCat($conn)
{
    extract($_POST);

    $message = array();

    $sqlQuery = "UPDATE `cats` SET `cat_name`='$cat' WHERE id=$id";
    $result = $conn->query($sqlQuery);

    if ($result) {
        $message = array("status" => "true", "msg" => "Category Updated successfully");
    } else {
        $message = array("status" => "false", "msg" => "Error Updating Category");
    }
    echo json_encode($message);
}




// delete single item
function deletCat($conn)
{
    $id = $_POST["id"];


    $message = array();

    $sqlQuery = "DELETE FROM cats WHERE id=$id";
    $result = $conn->query($sqlQuery);

    if ($result) {
        $message = array("status" => "true", "msg" => "Category Deleted successfully");
    } else {
        $message = array("status" => "false", "msg" => "Error Deleting Category");
    }
    echo json_encode($message);
}


// generate and finalize the Aciton

if (isset($action)) {
    $action($conn);
} else {
    echo "Error, Action is required, maadan soo baasin";
}
