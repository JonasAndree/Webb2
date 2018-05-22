<?php
$currentUser = "jonandre@kth.se";
// Create connection
$conn = new mysqli("localhost", "root", "", "tek15");
// Check connection
if ($conn->connect_error) {
    die("<div class='failed'>Connection failed: " . $conn->connect_error . "</div><br>");
}
$itemResult = $conn->query("SELECT * FROM `items` WHERE Player='$currentUser' AND active='active' AND subtype='$subtype'");
if (! $itemResult) {
    echo "Could not successfully run query  from DB: " . mysql_error();
    exit();
}
$item = $itemResult->fetch_assoc();
if (! empty($item)) {
    $imageType = "image/" . $item['imageType'];
    $currentName = $item["name"];
    $armor = $item['armor'];
    $damage = $item['damage'];
    echo "<div class='active-item-container'>";
    echo "<embed class='active-item-image' src='data:$imageType;base64," . base64_encode($item["image"]) . "'
                    onmouseover='itemInfo(\"$currentName-item-info\", \"on\", \"left\")'
                    onmouseout='itemInfo(\"$currentName-item-info\", \"off\", \"left\")'
                    onclick='subItems(\"$subtype-sub-item-container\")'/>";
    
        echo "<div id='$currentName-item-info' class='active-item-info $direction'>
                              <b>$currentName</b>
                              <br>Type: <i>$subtype </i>";
            if ($item['armor'] != 0)
                echo "<br>Armor: <i>$armor</i>";
            else if ($item['damage'] != 0)
                echo "<br>Damage: <i>$damage</i>";
        
        echo "</div>";
        
        
} else {
    echo "<div class='active-item-container'>";
        echo "<div id='$subtype-item-info' class='active-item-info $direction'>
                                              <b>Empty</b>
                                              <br>Type: <i>$subtype</i></div>";
        
        echo "<embed class='active-item-image' src='./images/empty.png'
                                          onmouseover='itemInfo(\"$subtype-item-info\", \"on\", \"left\")'
                                          onmouseout='itemInfo(\"$subtype-item-info\", \"off\", \"left\")'
                                          onclick='subItems(\"$subtype-sub-item-container\")'/>";
    
}

    echo "<div id='$subtype-sub-item-container' class='sub-item-container $direction'>";
        include 'addSubGear.php';
    echo "</div>";

echo "</div>";
?>