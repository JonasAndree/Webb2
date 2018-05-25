<?php 
    $name = $_REQUEST["name"];
    $subtype = $_REQUEST["subtype"];
    $type = $_REQUEST["type"];
    
    $currentUser = "jonandre@kth.se";
    // Create connection
    $conn = new mysqli("localhost", "root", "", "tek15");
    // Check connection
    if ($conn->connect_error) {
        die("<div class='failed'>Connection failed: " . $conn->connect_error . "</div><br>");
    }
    $itemResult = $conn->query("UPDATE `items` SET active='inactive' WHERE Player='$currentUser' AND active='active' AND subtype='$subtype'");
    
    $itemResult = $conn->query("UPDATE `items` SET active='active' WHERE Player='$currentUser' AND name='$name' AND subtype='$subtype'");
   
    
    $direction = "left";
    if ($type == "armor")
        $direction = "left";
    else
        $direction = "right";
    
    include "addActiveGear.php";

?>