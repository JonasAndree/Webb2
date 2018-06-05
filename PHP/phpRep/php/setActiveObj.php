<?php 

$currentUser = "jonandre@kth.se";
$conn = new mysqli("localhost", "root", "", "herodb");
if ($conn->connect_error) {
    die("<div class='failed'>Connection failed: " . $conn->connect_error . "</div><br>");
} 
$itemResult = $conn->query("SELECT * FROM `inventory` WHERE user='$currentUser'");

if (!$itemResult) {
    echo "Could not successfully run query  from DB: " . mysql_error();
    exit();
}

while ($itemName = $itemResult->fetch_assoc()) {
    
    $item = $conn->query("SELECT * FROM `items` WHERE name='$itemName'")->fetch_assoc();
    $object = $item['object'];
    $subtype = $item['subtype'];
    $type = $item['type'];
    if ($object != NULL) {
        echo "<script>console.log('wtf');</script>";
        echo "<script>loadDBObject('./php/model.php?name= $itemName &subtype= $subtype &type= $type');</script>";
    }
}
?>