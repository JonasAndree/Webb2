<?php 

$currentUser = "jonandre@kth.se";
$conn = new mysqli("localhost", "root", "", "herodb");
if ($conn->connect_error) {
    die("<div class='failed'>Connection failed: " . $conn->connect_error . "</div><br>");
} 
$itemResult = $conn->query("SELECT $subtype FROM `inventory` WHERE user='$currentUser'");

if (!$itemResult) {
    echo "Could not successfully run query  from DB: " . mysql_error();
    exit();
}
$itemName = $itemResult->fetch_assoc();

$itemNull = false;
if (!empty($itemName)) {
    $itemName = reset($itemName);
    if ($itemName != NULL){
        $item = $conn->query("SELECT * FROM `items` WHERE name='$itemName'")->fetch_assoc();
     
        $imageType = "image/" . $item['imagetype'];
        echo "<div class='active-item-container'>";
            echo "<embed class='active-item-image' src='data:$imageType;base64," . base64_encode($item["image"]) . "'
                        onmouseover='itemInfo(\"$itemName-item-info\", \"on\")'
                        onmouseout='itemInfo(\"$itemName-item-info\", \"off\")'
                        onclick='subItems(\"$subtype-sub-item-container\")'
                        />";
        
            echo "<div id='$itemName-item-info' class='active-item-info $direction'>
                <b>$itemName</b>
                <br>Type: <i>$subtype</i>";
            
                if ($item['armor'] != NULL) {
                    echo "<br>Armor: <i>".$item['armor']."</i>";
                }
                if ($item['damage'] != NULL) {
                    echo "<br>Damage: <i>".$item['damage']."</i>";
                    echo "<br>Damagetype: <i>".$item['damagetype']."</i>";
                }
                if ($item['element'] != NULL)
                    echo "<br>Damage: <i>".$item['element']."</i>";
                if ($item['energy'] != NULL)
                    echo "<br>Damage: <i>".$item['energy']."</i>";
                if ($item['housing'] != NULL)
                    echo "<br>Housing: <i>".$item['housing']."</i>";
            echo "</div>";
        } else {
            $itemNull = true;
        }
    } else {
        $itemNull = true;
    }
    if ($itemNull) {
        echo "<div class='active-item-container'>";
            echo "<div id='$subtype-item-info' class='active-item-info $direction'>
                      <b>Empty</b>
                      <br>Type: <i>$subtype</i></div>";
            
            echo "<embed class='active-item-image' src=''
                      onmouseover='itemInfo(\"$subtype-item-info\", \"on\")'
                      onmouseout='itemInfo(\"$subtype-item-info\", \"off\")'
                      onclick='subItems(\"$subtype-sub-item-container\")'/>";
    }

    echo "<div id='$subtype-sub-item-container' class='sub-item-container $direction'>";
        include 'addSubGear.php';
    echo "</div>";

echo "</div>";
?>