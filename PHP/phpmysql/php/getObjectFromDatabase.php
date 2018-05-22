<?php
    $currentUser = "jonandre@kth.se";
    $itemName = $_REQUEST["q"];
    // Create connection
    $conn = new mysqli("localhost", "root", "", "tek15");
    // Check connection
    if ($conn->connect_error) {
        die("<div class='failed'>Connection failed: " . $conn->connect_error."</div><br>");
    }
    $item = $conn->query("SELECT * FROM `items` WHERE Player='$currentUser' AND name='$itemName'")->fetch_assoc();
    $obj = $item["3dobject"];
    echo $obj;
    $conn->close();
?>