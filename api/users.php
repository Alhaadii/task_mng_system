<?php
header("Content-Type: application/json");
include("../config/connection.php");


$action = $_POST['action'];

function getUsers($conn)
{
    $data = array();
    $message = array();

    $sql = "SELECT * FROM users";
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
function getUser($conn)
{
    $data = array();
    $message = array();
    $id = $_POST['id'];

    $sql = "SELECT * FROM users WHERE id=$id";
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

    $sqlQuery = "INSERT INTO `users`(`username`, `email`, `password`,`type`) VALUES ('$username', '$email', MD5('$password'),'$type')";
    $result = $conn->query($sqlQuery);

    if ($result) {
        $message = array("status" => true, "msg" => "User Registered successfully");
    } else {
        $message = array("status" => false, "msg" => "Error adding user");
    }
    echo json_encode($message);
}



// update users
function updateUser($conn)
{
    extract($_POST);

    $message = array();

    $sqlQuery = "UPDATE `users` SET `username`='$username',`email`='$email',`password`='$password',`type` = '$type' WHERE id=$id";
    $result = $conn->query($sqlQuery);

    if ($result) {
        $message = array("status" => "true", "msg" => "User Updated successfully");
    } else {
        $message = array("status" => "false", "msg" => "Error Updating user");
    }
    echo json_encode($message);
}




// delete single item
function deletUser($conn)
{
    $id = $_POST["id"];


    $message = array();

    $sqlQuery = "DELETE FROM users WHERE id=$id";
    $result = $conn->query($sqlQuery);

    if ($result) {
        $message = array("status" => "true", "msg" => "User Deleted successfully");
    } else {
        $message = array("status" => "false", "msg" => "Error Deleting user");
    }
    echo json_encode($message);
}







// generate and finalize the Aciton

if (isset($action)) {
    $action($conn);
} else {
    echo "Error, Action is required, maadan soo baasin";
}
