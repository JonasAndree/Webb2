<html>
    <head>
   		<link rel="stylesheet" type="text/css" href="css/inventory.css"/>
	</head>
	<body>
        <?php 
            $playerName = "jonandre@kth.se";
            
            $serverName = "localhost";
            $userName = "root";
            $serverPassword = "";
            $dbName = "tek15";
            // Create connection
            $conn = new mysqli($serverName, $userName, $serverPassword, $dbName);
            // Check connection
            if ($conn->connect_error) {
                die("<div class='failed'>Connection failed: " . $conn->connect_error . "</div><br>");
            }
            $inventory = $conn->query("SELECT * FROM `inventory` WHERE Player='$playerName'")->fetch_assoc();
            
            $helm = $inventory["Head"];
            
            $conn->query("SELECT * FROM `items` WHERE name='$helm'")->fetch_assoc();
            
            echo "<div id='helm'>";
            echo "Name:$helm[name]";
            echo "</div>";
            
         ?>
	</body>
</html>