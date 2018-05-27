<?php
    $name = $_REQUEST["name"];
    $currentUser = "jonandre@kth.se";
    $conn = new mysqli("localhost", "root", "", "herodb");
    if ($conn->connect_error) {
        die("<div id='failed'>Connection failed: " . $conn->connect_error . "<div><br>");
    } else {
        echo "<div id='success'>Connection successful.<div><br>";
    }
    $conn->query("UPDATE `storage` SET deleted='true' WHERE user='$currentUser' AND item='$name' AND deleted='NULL'");
    $conn->close();
?>