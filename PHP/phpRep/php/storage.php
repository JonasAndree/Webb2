<?php 
    $currentUser = "jonandre@kth.se";
    $conn = new mysqli("localhost", "root", "", "herodb");
    
    if ($conn->connect_error) {
        die("<div class='failed'>Connection failed: " . $conn->connect_error."</div><br>");
    }
    $itemNames = $conn->query("SELECT * FROM `storage` WHERE user='$currentUser' AND active='inactive' AND deleted='NULL'");
    
    while ($itemItem = $itemNames->fetch_assoc()) {
        $itemName = $itemItem["item"];
        $item = $conn->query("SELECT * FROM `items` WHERE name='$itemName'")->fetch_assoc();
        
        $imageType = "image/" . $item['imagetype'];
        $subtype = $item["subtype"];
        $currentName = $itemName;
        $type = $item['type'];
        
        echo "<div class='storage-item-container'>
                 <embed class='bag-item-image' src='data:$imageType;base64," . base64_encode($item["image"]) . "'
                        onmouseover='itemInfo(\"storage-$currentName-item-info\", \"on\")'
                        onmouseout='itemInfo(\"storage-$currentName-item-info\", \"off\")'
                        onclick='setItem(\"$currentName\", \"$subtype\", \"$type\")'
                        oncontextmenu='showDeleteMenu(\"$currentName\")'
                        />";
        
                echo "<div id='storage-$currentName-item-info' class='storage-item-info'>
                          <b>$currentName</b>
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
            echo "</div>
        </div>";
    }
?>