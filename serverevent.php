<?php 
include("api.php"); // database connection

header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");

$query = "SELECT date_time FROM sleep_table WHERE date_time > ?";
$stmt = $conn->prepare($query);
$ts = date();

while(true) 
{
    if ($result = $stmt->execute([$ts])) {
        $row = $result->fetch_assoc();
        echo "data: " . $row['date_time'] . "\n\n";
        $ts = $row['date_time'];
        flush();
    }
    //the application will sleep for two seconds 
    sleep(2);
}
?>