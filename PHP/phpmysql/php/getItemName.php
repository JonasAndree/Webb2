<?php
    $currentUser = "jonandre@kth.se";
    $currentSubType = $_REQUEST["q"];
    // Create connection
    $conn = new mysqli("localhost", "root", "", "tek15");
    // Check connection
    if ($conn->connect_error) {
        die("<div class='failed'>Connection failed: " . $conn->connect_error."</div><br>");
    }
    $item = $conn->query("SELECT * FROM `inventory` WHERE Player='$currentUser'")->fetch_assoc();
    echo $item[$currentSubType];
    $conn->close();
    
?>