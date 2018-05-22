<?php
    function setMainItems($type, $conn, $inventory) {
        $tmpItem = $inventory["$type"];
        $imageType = "image/png";
        if ($tmpItem != NULL) {
            
            $item = $conn->query("SELECT * FROM `items` WHERE name='$tmpItem'")->fetch_assoc();
            $imageContent = $item["image"];
            echo "<embed class='disp-items' src='data:$imageType;base64," . base64_encode($imageContent) . "'
                                       onmouseover='showItemInfo(\"$tmpItem-item-info\", \"on\")'
                                       onmouseout='showItemInfo(\"$tmpItem-item-info\", \"off\")'
                                       onclick='selectItems(\"$type\", \"false\")' />";
            
            $itemInfo = $conn->query("SELECT * FROM `items` WHERE name='$tmpItem'")->fetch_assoc();
            $subtype = $itemInfo['subtype'];
            $armor = $itemInfo['armor'];
            $damage = $itemInfo['damage'];
            echo "<div id='$tmpItem-item-info' class='info-items'>
                                  <b>$tmpItem</b>
                                  <br>Type: <i>$subtype </i>";
            if ($itemInfo['damage'] == 0)
                echo "<br>Armor: <i>$armor</i>";
            else
                echo "<br>Damage: <i>$damage</i>";
            echo "</div>";
        } else {
            
            echo "<embed src='images/empty.png' class='disp-items'
                              onmouseover='showItemInfo(\"$type-item-info\", \"on\")'
                              onmouseout='showItemInfo(\"$type-item-info\", \"off\")'
                              onclick='selectItems(\"empty\", \"false\")'/>";
            echo "<div id='$type-item-info' class='info-items'> 
                                  <b>Empty</b>
                                  <br>Type: <i>$type</i>
                              </div>";
        }
        echo "</div>";
    }
    
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
    
    $result = $conn->query("SELECT * FROM `inventory` WHERE Player='$currentUser'");
    
    // The array would be NULL if there are no other users.
    if ($result != NULL) {
        // output data of each row
        $inventory = $result->fetch_assoc();
        
        // Hämta
        $user = $conn->query("SELECT * FROM `users` WHERE mail='$currentUser'")->fetch_assoc();
        echo "<div id='user-name'>" . $user["firstname"] . " " . $user["lastname"] . "</div>";
        
        echo "<div id='head-socket'>";
        setMainItems("Head", $conn, $inventory);
        
        echo "<div id='chest-socket'>";
        setMainItems("Chest", $conn, $inventory);
        
        echo "<div id='arms-socket'>";
        setMainItems("Arms", $conn, $inventory);
        
        echo "<div id='leggs-socket'>";
        setMainItems("Leggs", $conn, $inventory);
        
        echo "<div id='cape-socket'>";
        setMainItems("Cape", $conn, $inventory);
        
        echo "<div id='primary-socket'>";
        setMainItems("Primary", $conn, $inventory);
        
        echo "<div id='secundary-socket'>";
        setMainItems("Secundary", $conn, $inventory);
        
        echo "<div id='heavy-socket'>";
        setMainItems("Heavy", $conn, $inventory);
    } else {
        echo "0 results";
    }
    
    $conn->close();
?>