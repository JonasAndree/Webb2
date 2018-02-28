<html>
    <body>
    	<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
    		Username:<input type="text" name="name">
    	</form>
    	<?php 
    	   echo "Name:" . $_POST["name"];
    	   
       	?>
	</body>
</html>