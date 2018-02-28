<html>
	<body>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">	
			Firstname: <input type="text" name="firstname" required><br>
			Lastname: <input type="text" name="lastname" required><br>
			Mail: <input type="email" name="mail" required><br>
			Password: <input type="password" name="password" required><br>
			Birthdate: <input type="date" name="birthdate"><br>	
			<input type="submit">
		</form>
		
		
        <?php 
            $firstName = $lastName = $mail = $password = $birthdate = "";
        
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $alEnterd = true;
                
                $firstName = test_input($_POST["firstname"]);
                $lastName = test_input($_POST["lastname"]);
                $mail = test_input($_POST["mail"]);
                $password = test_input($_POST["password"]);
                
                $birthdate = $_POST["birthdate"];
                
                if (!empty($_POST["firstname"])) {
                    $firstName = $_POST["firstname"];
                } else {
                    $alEnterd = false;
                    echo "Pleace select a firstname! <br>";
                }
                if (!empty($_POST["lastname"])) {
                    $lastName = $_POST["lastname"];
                } else {
                    $alEnterd = false;
                    echo "Pleace select a lastname! <br>";
                }
                if (!empty($_POST["mail"])) {
                    $mail = $_POST["mail"];
                } else {
                    $alEnterd = false;
                    echo "Pleace select a mail! <br>";
                }
                if (!empty($_POST["password"])) {
                    $password = $_POST["password"];
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
                        die("Connection failed: " . $conn->connect_error);
                    } else {
                        echo "Connection successful";
                    }
                    $sql = "INSERT INTO `users`(`firstname`, `lastname`, `mail`, `password`, `birthdate`) VALUES 
                                               ('".$firstName."', '".$lastName."','".$mail."','".$password."','".$birthdate."')";
                    
                    if ($conn->query($sql) === TRUE) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
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
        
	</body>
</html>
        