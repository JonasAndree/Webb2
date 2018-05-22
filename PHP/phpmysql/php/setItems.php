<?php
    $currentUser = "jonandre@kth.se";
    $currentItemName = $_REQUEST["q"];
    // Create connection
    $conn = new mysqli("localhost", "root", "", "tek15");
    // Check connection
    if ($conn->connect_error) {
        die("<div class='failed'>Connection failed: " . $conn->connect_error."</div><br>");
    } 
    
    $item = $conn->query("SELECT * FROM `items` WHERE `name`='$currentItemName' AND `Player`='$currentUser'");
    $row = $item->fetch_assoc();
    $imageContent = $row["image"];
    $itemSubtype = $row["subtype"];
    //echo '<script type="text/javascript">console.log("ses");sessionStorage.setItem("update", '.$itemSubtype.');</script>';
    echo "<embed class='disp-items' src='data:image/png;base64,".base64_encode($imageContent)."' 
           onmouseover='showItemInfo(\"$currentItemName-item-info\", \"on\")'  
           onmouseout='showItemInfo(\"$currentItemName-item-info\", \"off\")' 
           onclick='selectItems(\"$itemSubtype\", \"false\")'/>";
    $itemInfo = $conn->query("SELECT * FROM `items` WHERE name='$currentItemName'")->fetch_assoc();
    $subtype = $itemInfo['subtype'];
    $armor = $itemInfo['armor'];
    $damage = $itemInfo['damage'];
    echo "<div id='$currentItemName-item-info' class='info-items'>
        <b>$currentItemName</b>
        <br>Type: <i>$subtype </i>";
        if ($itemInfo['damage'] == 0)
            echo "<br>Armor: <i>$armor</i>";
        else
            echo "<br>Damage: <i>$damage</i>";
   echo "</div>"; 
            
    $conn->query("UPDATE `items` SET `active`='inactive' WHERE `subtype`='$itemSubtype' AND `active`='active' AND `Player`='$currentUser'");
    $conn->query("UPDATE `items` SET `active`='active' WHERE `name`='$currentItemName' AND `Player`='$currentUser'");
    $conn->query("UPDATE `inventory` SET `$itemSubtype`='$currentItemName' WHERE `Player`='$currentUser'");
    $conn->close();
?>