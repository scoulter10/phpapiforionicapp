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





    

            $server = "localhost";

            $user = "scoulter10";

            $pass = "2whWwVG104cSygTd";

            $db = "sleep_log";

        

            $conn = new mysqli($server, $user, $pass, $db);  

    

            if($conn->connect_error){

                echo "Connection failed: ".$conn->connect_error;

            }



            $rest_json = file_get_contents("php://input");

            $_POST = json_decode($rest_json, true);

            $date_time = mysqli_real_escape_string($conn, $_POST['date_time']);

            $datetimeclean = filter_var($date_time, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

      



$insert = 'INSERT INTO sleep_table VALUES("", "' . $date_time . '", "1")';



if($conn->query($insert) === TRUE){

    $output =  " $date_time " ;

    echo json_encode($output);

}else{

    echo json_encode("error" .$conn->error);

}



$conn->close();



?>

