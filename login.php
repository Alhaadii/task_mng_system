<?php
header("Content-Type: application/json");
include("./config/connection.php");


$action = $_POST['action'];

// login checking
function login($conn)
{
    extract($_POST);
    $message = array();
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $message = array("status" => "true", "msg" => "success Login");
    } else {
        $message = array("status" => "false", "msg" => "Invalid username or password");
    }
    echo json_encode($message);
}


if (isset($action)) {
    $action($conn);
} else {
    echo "Error, Action is required, maadan soo baasin";
}
