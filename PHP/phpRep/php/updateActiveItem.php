<?php 
    $name = $_REQUEST["name"];
    $subtype = $_REQUEST["subtype"];
    $type = $_REQUEST["type"];
    $currentUser = "jonandre@kth.se";
    
    $conn = new mysqli("localhost", "root", "", "herodb");
   
    
    $oldItem = $conn->query("SELECT $subtype FROM `inventory` WHERE user='$currentUser'")->fetch_assoc();
    $oldItemName = reset($oldItem);
    $conn->query("UPDATE `storage` SET active='inactive' WHERE user='$currentUser' AND item='$oldItemName' AND deleted='NULL'");
    $conn->query("UPDATE `storage` SET active='active' WHERE user='$currentUser' AND item='$name' AND deleted='NULL'");
    $conn->query("UPDATE `inventory` SET $subtype='$name' WHERE user='$currentUser'");
    
    $direction = "left";
    if ($type == "armor")
        $direction = "left";
    else
        $direction = "right";
    
    include "addActiveGear.php";
?>