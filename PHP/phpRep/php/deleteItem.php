<?php 


$serverName = "localhost";
$userName = "root";
$serverPassword = "";
$dbName = "tek15";

// Create connection
$conn = new mysqli($serverName, $userName, $serverPassword, $dbName);
// Check connection
if ($conn->connect_error) {
    die("<div id='failed'>Connection failed: " . $conn->connect_error . "<div><br>");
} else {
    echo "<div id='success'>Connection successful.<div><br>";
}


$sql = "DELETE  FROM `items` WHERE name='$namn' AND ;
$users = $conn->query($sql);

$user_array = $users->fetch_assoc();




}
$conn->close();


?>