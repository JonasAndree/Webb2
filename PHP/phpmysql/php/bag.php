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

$bagResult = $conn->query("SELECT * FROM `items` WHERE Player='$currentUser'");
// $bagResult = $conn->query("SELECT * FROM `items` WHERE Player='$currentUser'");

// The array would be NULL if there are no other users.
if ($result != NULL) {
    $imageType = "image/png";
    
    while ($row = $bagResult->fetch_assoc()) {
        $imageContent = $row["image"];
        $subtype = $row["subtype"];
        $currentName = $row["name"];
        $armor = $row['armor'];
        $damage = $row['damage'];
        
        echo "<div class='container-consum'>
                                <embed class='bag-items' src='data:$imageType;base64," . base64_encode($imageContent) . "'  
                                   onmouseover='showItemInfo(\"$currentName-item-con-info\", \"on\")'
                                   onmouseout='showItemInfo(\"$currentName-item-con-info\", \"off\")'
                                   onclick='setItems(\"$currentName\", \"$subtype\")'/>";
        
        echo "<div id='$currentName-item-con-info' class='info-consumable-items'>
                          <b>$currentName</b>
                          <br>Type: <i>$subtype </i>";
        if ($row['armor'] != 0)
            echo "<br>Armor: <i>$armor</i>";
        else if ($row['damage'] != 0)
            echo "<br>Damage: <i>$damage</i>";
        echo "</div></div>";
    }
}
?>