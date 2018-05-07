<?php
    $currentUser = "jonandre@kth.se";
    $currentSubType = $_REQUEST["q"];
    // Create connection
    $conn = new mysqli("localhost", "root", "", "tek15");
    // Check connection
    if ($conn->connect_error) {
        die("<div class='failed'>Connection failed: " . $conn->connect_error."</div><br>");
    } 
    
    $item = $conn->query("SELECT * FROM `items` WHERE subtype='$currentSubType'");
    
    while ($row = $item->fetch_assoc()) {
        if ($row["active"] != "active") {
            $imageContent = $row["image"];
            $itemName = $row["name"];
            echo "<div class='info-subitem-container'><embed class='disp-items disp-sub-items' src='data:image/png;base64,".base64_encode($imageContent)."'
                   onmouseover='showItemInfo(\"$itemName-item-info\", \"on\")'  
                   onmouseout='showItemInfo(\"$itemName-item-info\", \"off\")' 
                   onclick='update3DOBJ(\"$itemName\"); setItems(\"$itemName\", \"$currentSubType\");'/>";
            //echo "<script>update3DOBJ(\"$itemName\");</script>"


            $itemInfo = $conn->query("SELECT * FROM `items` WHERE name='$itemName'")->fetch_assoc();
            $subtype = $itemInfo['subtype'];
            $armor = $itemInfo['armor'];
            $damage = $itemInfo['damage'];
            
            echo "<div id='$itemName-item-info' class='info-subitems'>
                      <b>$itemName</b>
                      <br>Type: <i>$subtype </i>";
                      if ($itemInfo['damage'] == 0)
                          echo "<br>Armor: <i>$armor</i>";
                      else
                          echo "<br>Damage: <i>$damage</i>";
                  echo "</div></div>";            
        }
    }
    
    $conn->close();
?>