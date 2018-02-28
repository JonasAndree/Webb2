<?php
	/**
	 * Old php code probably working on your database. 
	 */
	echo "Register php running";
	/* tetects if the formuler is not empty. */
	if(isset($_POST['username']) && 
	   isset($_POST['password']) && 
	   isset($_POST['mail']) &&
	   $_POST['username'] != "" &&
	   $_POST['password'] != "" &&
	   $_POST['mail'] != ""	){
		// Stores the username into a variable.
		$namn = $_POST["username"];
		$mail = $_POST["mail"];

		/* Connects to the server and database we are intrtessed in.
		 * Using root as a user and with no password. 
		 */
		$conn = new mysqli('jonasandree.se','Jonas','jonas','tek13login', 3306) or die(mysql_error);
		
		echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL . "<br>";
		echo "Host information: " . mysqli_get_host_info($conn) . PHP_EOL;
				
		// Adds the table userinfo with the new data.
		$conn->query("INSERT INTO userinfo(mail, username, password) 
					  VALUE('".$_POST['mail']."', 
					 		'".$_POST['username']."', 
					  		'".$_POST['password']."')");
					  		
		// Closes the connection to the server.
		$conn->close();
		
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
	} else {
		// Closes this window.
		echo "<script>window.close();</script>";
	}
?>