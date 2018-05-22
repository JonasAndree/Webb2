<?php 
    $currentUser = "jonandre@kth.se";
    // Create connection
    $conn = new mysqli("localhost", "root", "", "tek15");
    // Check connection
    if ($conn->connect_error) {
        die("<div class='failed'>Connection failed: " . $conn->connect_error."</div><br>");
    }

    $bagResult = $conn->query("SELECT * FROM `items` WHERE Player='$currentUser' AND NOT active='active'");
    
    while ($item = $bagResult->fetch_assoc()) {
        $imageType = "image/" . $item['imageType'];
        $subtype = $item["subtype"];
        $currentName = $item["name"];
        
        $armor = $item['armor'];
        $damage = $item['damage'];
        
        echo "<div class='bag-item-container'>
                 <embed class='bag-item-image' src='data:$imageType;base64," . base64_encode($item["image"]) . "'
                        onmouseover='itemInfo(\"$currentName-item-info\", \"on\", \"bottom\")'
                        onmouseout='itemInfo(\"$currentName-item-info\", \"off\", \"bottom\")'
                        onclick='subItems(\"$currentName\", \"$subtype\")'/>";
        
        echo "<div id='$currentName-item-info' class='bag-item-info'>
                          <b>$currentName</b>
                          <br>Type: <i>$subtype </i>";
        
            if ($item['armor'] != 0)
                echo "<br>Armor: <i>$armor</i>";
            else if ($item['damage'] != 0)
                echo "<br>Damage: <i>$damage</i>";
        echo "</div></div>";
    }

?>