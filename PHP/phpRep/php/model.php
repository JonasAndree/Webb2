<?php
   
    //$name = $_REQUEST["name"];
    //$subtype = $_REQUEST["subtype"];
    //$type = $_REQUEST["type"];
    $name = "IonBlaster";
    $currentUser = "jonandre@kth.se";
    
    $conn = new mysqli("localhost", "root", "", "herodb");
    
    $modelArray = $conn->query("SELECT object FROM `items` WHERE name='$name'")->fetch_assoc();
    
    $model = reset($modelArray);
    
    echo $model;
?>