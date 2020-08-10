<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

include("api.php");

$rest_json = file_get_contents("php://input");
$_POST = json_decode($rest_json, true);

$update = $_POST["state_value"];


$update = 'UPDATE state_table SET state_value = "0" WHERE state_id = "1" ';

if($conn->query($update) === TRUE){
    $output = "Pi state changed . $update . ";
    echo json_encode($output);
}else{
    echo json_encode("error" .$conn->error);
}

$conn->close();


?>