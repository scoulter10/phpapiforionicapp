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
include("conn.php");

$data = file_get_contents("php://input");

    if (isset($data)) {

        $request = json_decode($data);

        $piname = $request->pi_name;

        $piip = $request->pi_ip;

                }

      $piname= mysqli_real_escape_string($con,$piname);


       $piname = stripslashes($piname);


    $sql = "SELECT * FROM pi_table WHERE pi_id = '1' AND pi_ip = '$piip' AND pi_name = '$piname'";

      $result = mysqli_query($con,$sql);

      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      $active = $row['active'];

      $count = mysqli_num_rows($result);

     

      // If result matched myusername and mypassword, table row must be 1 row                    

      if($count > 0) {

     $response= "Your Login success";

      }else {

    $response= "Your Pi name or your Pi IP is invalid";         

      }

 echo json_encode( $response);

?>