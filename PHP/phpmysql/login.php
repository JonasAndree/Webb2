<html>
    <head>
   		<link rel="stylesheet" type="text/css" href="css/lesson.css"/>
	</head>
	<body>
		<div id="login-status">
    		<div id="form-container">
        		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        			Mail: <input type="email" name="mail" required><br>
        			Password: <input type="password" name="password" required><br>
        			<input id="submit" type="submit">
        		</form>
    		</div>
    		<div id="log-out">
    			Mail:<b id="logedin-mail"></b>
    			<button onclick="logout()">Log out</button>
			</div>
		</div>
		
        <?php 
            $mail = $password = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $alEnterd = true;
                
                if (!empty($_POST["mail"])) {
                    $mail = test_input($_POST["mail"]);
                } else {
                    $alEnterd = false;
                    echo "Pleace select a mail! <br>";
                }
                if (!empty($_POST["password"])) {
                    $password = test_input($_POST["password"]);
                } else {
                    $alEnterd = false;
                    echo "Pleace select a password! <br>";
                }
                
                if ($alEnterd == true) {
                    $servername = "localhost";
                    $username = "Jonas";
                    $serverpassword = "r32bsW6XvAMhEVrA";
                    $dbname = "tek15";
                    
                    // Create connection
                    $conn = new mysqli($servername, $username, $serverpassword, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("<div id='failed'>Connection failed: " . $conn->connect_error."<div><br>");
                    } else {
                        echo "<div id='success'>Connection successful.<div><br>";
                    }
                    /* Tänk på att sätta rätt ' ´ täcken på rätt platts. ' om det är någonting som man
                     * kollar om den är lika med så är det ' om det är en kolumn så använd ´ ´.
                     */
                    $sql = "SELECT * FROM `users` WHERE mail='$mail' AND password='$password'";
                    $users = $conn->query($sql);
                    
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
                    $user_array = $users->fetch_assoc();
                    //The array would be NULL if there are no other users. 
                    if ($user_array != NULL) {
                        echo "<br>The username and password is ok!<br>";
                        echo "<script>document.getElementById('logedin-mail').innerHTML = ' ". $user_array["firstname"]." ". $user_array["lastname"]."'</script>";
                        echo "<script>document.getElementById('form-container').style.display = 'none';</script>";
                        echo "<script>document.getElementById('log-out').style.display = 'inline-block';</script>";
                    } else {
                        echo "<br>Incorrect password or mail.";
                    }                    
                    $conn->close();
                }
            }
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
        
		<script type="text/javascript" src="js/menu.js"></script>
	</body>
</html>
        