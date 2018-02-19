<html>
	<body>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">	
			Name: <input type="text" name="name" required><br>
			Password: <input type="password" name="password" required><br>	
			<input type="submit">
			
		</form>
		<?php 
		
		  if ($_SERVER["REQUEST_METHOD"] == "POST") {
		      if (!empty($_POST["name"])) {
    		      echo "<button>Username:</button> " . $_POST["name"] . "<br>";
		      } else {
		          echo "Pleace select a username! <br>";
		      }
              echo "Password: " . $_POST["password"] . "<br>";
		  }
		?>
	</body>
</html>