<?php 
    $currentUser = "jonandre@kth.se";
    $conn = new mysqli("localhost", "root", "", "herodb");
    $inventory = $conn->query("SELECT * FROM `subtyps`");
    
    echo "<div id='armor-arrow' class='arrow left' onclick='showArmor(\"armor-arrow\", \"armor-container\")' >";
        echo "<img class='arrow-img' alt='tap your mouse here to show content' src='images/tap.png'>";
    echo "</div>";
    echo "<div id='armor-container'>";
        echo "<div class='armor-column'>";
            while ($subtypeObj = $inventory->fetch_assoc()) {
                if ($subtypeObj["type"] == "armor") {
                    $subtype = $subtypeObj['name'];
                    echo "<div id='$subtype-gear'>";
                        $direction = "left";
                        include 'addActiveGear.php';
                    echo "</div>";
                }
            }
        echo "</div>";
    echo "</div>";
    
    
    $inventory = $conn->query("SELECT * FROM `subtyps`");
    echo "<div id='wpn-arrow' class='arrow right' onclick='showArmor(\"wpn-arrow\", \"wpn-container\")' >";
        echo "<img id='right-arrow-img' class='arrow-img' alt='tap your mouse here to show content' src='images/tap.png'>";
    echo "</div>";
    echo "<div id='wpn-container'>";
        echo "<div class='wpn-column'>";
            while ($subtypeObj = $inventory->fetch_assoc()) {
                if ($subtypeObj["type"] == "weapon") {
                    $subtype = $subtypeObj['name'];
                    echo "<div id='$subtype-gear'>";
                        $direction = "right";
                        include 'addActiveGear.php';
                    echo "</div>";
                }
            }
        echo "</div>";
    echo "</div>";
?>