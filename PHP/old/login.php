<?php
	// Stores the username into a variable.
	$namn = $_POST["username"];
	echo "Connecting to server...";
	/* Connects to the server and database we are intrtessed in.
	 * Using root as a user and with no password. 
	 */
	$conn = new mysqli('jonasandree.se','Jonas','jonas','tek13login', 3306) or die(mysql_error);
	
	
	echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL . "<br>";
	echo "Host information: " . mysqli_get_host_info($conn) . PHP_EOL;
	
	// Selects al the users from userinfo.
	$users = $conn->query("SELECT * FROM userinfo");
	echo "<br>Quary created.";
	
	// Closes the connection to the server.
	$conn->close();
	
	while($row = $users->fetch_assoc()){
		if($row["username"] == $_POST["username"] && $row["password"] == $_POST["password"]) {
			echo "<br>The username and password is ok!";
	  		
	  		$mail = $row["mail"];
	  		
	  		/* Run java code
	  		 * Loggin.
	  		 */
	  		echo '<script type="text/javascript">'
	  				, 'localStorage.setItem("state", "true");'
	  				, 'localStorage.setItem("user", "',$namn,'");'
	  				, 'localStorage.setItem("mail", "',$mail,'");'
	  				, '</script>';
	  		
	  		// Closes this window.
			echo "<script>window.close();</script>";	
		} 
	}
	echo "PHP login faild";
	echo '<script type="text/javascript">'
	  		, 'localStorage.setItem("state", "faild");'
	  		, 'localStorage.setItem("user", "none");'
	  		, '</script>';
	echo "<script>window.close();</script>";
?>