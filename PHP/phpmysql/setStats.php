<?php
    $serverName = "localhost";
    $userName = "root";
    $serverPassword = "";
    $dbName = "tek15";
    
    $currentUser = "jonandre@kth.se";
    
    // Create connection
    $conn = new mysqli($serverName, $userName, $serverPassword, $dbName);
    // Check connection
    if ($conn->connect_error) {
        die("<div class='failed'>Connection failed: " . $conn->connect_error . "</div><br>");
    }
    
    $itemsNames = $conn->query("SELECT `Head`, `Chest`, `Arms`, `Leggs`, `Cape`, `Primary`, `Secundary`, `Heavy` FROM `inventory` WHERE Player='$currentUser'")->fetch_assoc();
    $armor = 0;
    $damage = 0;
    
    $keys = array_keys($itemsNames);
    
    for ($i = 0; $i < count($keys); ++ $i) {
        // echo $keys[$i] . ' : ' . $itemsNames[$keys[$i]] ;
        
        $tempItemName = $itemsNames[$keys[$i]];
        $stats = $conn->query("SELECT * FROM `items` WHERE `name`='$tempItemName'");
        
        while ($statsRow = $stats->fetch_assoc()) {
            $armor += $statsRow["armor"];
            $damage += $statsRow["damage"];
        }
    }
    echo "<div id='armor-stats'>Armor: $armor</div>";
    echo "<div id='wpn-stats'>Damaga: $damage</div>";
?>