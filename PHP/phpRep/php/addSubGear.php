<?php
$currentUser = "jonandre@kth.se";
$conn = new mysqli("localhost", "root", "", "herodb");
if ($conn->connect_error) {
    die("<div class='failed'>Connection failed: " . $conn->connect_error . "</div><br>");
}

$itemNames = $conn->query("SELECT item FROM `storage` WHERE user='$currentUser' AND active='inactive' AND deleted='NULL'");

if (!$itemNames) {
    echo "Could not successfully run query  from DB: " . mysql_error();
    exit();
}
while ($itemName = $itemNames->fetch_assoc()) {
    $itemName = reset($itemName);
    $item = $conn->query("SELECT * FROM `items` WHERE name='$itemName' AND subtype='$subtype'")->fetch_assoc();
    if (!empty($item)) {
        echo "<div class='sub-item $direction'>";
            
            $imageType = "image/" . $item['imagetype'];
            $type = $item['type'];
            echo "<embed class='sub-item-image' src='data:$imageType;base64," . base64_encode($item["image"]) . "'
                        onmouseover='itemInfo(\"sub-$itemName-item-info-container\", \"on\")'
                        onmouseout='itemInfo(\"sub-$itemName-item-info-container\", \"off\")'
                        onclick='setItem(\"$itemName\", \"$subtype\", \"$type\")'
                        oncontextmenu='showDeleteMenu(\"$itemName\")'
                        />";
            
            echo "<div id='sub-$itemName-item-info-container' class='sub-item-info-container ' > ";
                echo "<div class='sub-item-info $direction down'>
                          <b>$itemName</b>
                          <br>Type: <i>$subtype </i>";
                    if ($item['armor'] != 0) {
                        echo "<br>Armor: <i>".$item['armor']."</i>";
                    }
                    if ($item['damage'] != 0) {
                        echo "<br>Damage: <i>".$item['damage']."</i>";
                        echo "<br>Damagetype: <i>".$item['damagetype']."</i>";
                    }
                    if ($item['element'] != 0)
                        echo "<br>Element: <i>".$item['element']."</i>";
                    if ($item['energy'] != 0)
                        echo "<br>Damage: <i>".$item['energy']."</i>";
                    if ($item['housing'] != 0)
                        echo "<br>Housing: <i>".$item['housing']."</i>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
}
?>