<html>
    <head>
   		<link rel="stylesheet" type="text/css" href="css/lesson.css"/>
	</head>
	<body>
        <?php 
            $serverName = "localhost";
            $userName = "root";
            $serverPassword = "";
            $dbName = "tek15";
            
            // Create connection
            $conn = new mysqli($serverName, $userName, $serverPassword, $dbName);
             // Check connection
            if ($conn->connect_error) {
                die("<div class='failed'>Connection failed: " . $conn->connect_error."</div><br>");
            } else {
                echo "<div class='success'>Connection successful.</div><br>";
            }
            
            $sql = "SELECT * FROM `users`";
            $result = $conn->query($sql);
            
            /*
             * Returns an associative array of strings representing the fetched row
             * in the result set, where each key in the array represents the name of
             * one of the result set's columns or NULL if there are no more rows in
             * resultset.
             *
             * If two or more columns of the result have the same field names, the last
             * column will take precedence. To access the other column(s) of the same
             * name, you either need to access the result with numeric indices by using
             * mysqli_fetch_row() or add alias names.
             */
            //The array would be NULL if there are no other users.
            if ($result != NULL) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    if ($row["firstname"] == "Robin")
                        echo "<div class='users-container-robin'> Mail: " . $row["mail"]. " <br> Firstname: " . $row["firstname"]. " <br> Lastname: " . $row["lastname"]. " <br> Birthdate: " . $row["birthdate"]. "</div>";
                    else
                        echo "<div class='users-container'> Mail: " . $row["mail"]. " <br> Firstname: " . $row["firstname"]. " <br> Lastname: " . $row["lastname"]. " <br> Birthdate: " . $row["birthdate"]. "</div>";
                }
            } else {
                echo "0 results";
            }
            $conn->close();
        ?>
        
	</body>
</html>