<?php
	//$id = $_GET["id"];
	$conn = new mysqli('jonasandree.se','Jonas','jonas','tek13login', 3306) or die(mysql_error);
	$users = $conn->query("SELECT * FROM userinfo");
	$conn->close();
	while($row = $users->fetch_assoc()){
		if($row["mail"] == "jonandre@kth.se"){
			echo '<img id="u-img" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>';
		} 
	}
?>