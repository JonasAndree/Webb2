<?php
	/* Connects to the server and database we are intrtessed in.
	 * Using root as a user and with no password. 
	 */
	$conn = new mysqli('jonasandree.se','Jonas','jonas','tek13login', 3306) or die(mysql_error);
	// Selects al the users from userinfo.
	$content = $conn->query("SELECT * FROM homecontent");
	echo "<br>You need to learn how to use:";
	// Closes the connection to the server.
	$conn->close();
	
	while($row = $content->fetch_assoc()){
		if ($row["type"]=="php") {
	  		echo '<li class="javascript-li" onclick="showHideInfo(',$row["cssvar"],')">'
	  			, 	'<a class="heading">',$row["heading"],'</a>'
	  			,	'<br>'
	  			, 	'<var id="',$row["css"],'">'
	  			, 		'<a class="info">',$row["info"],'</a>'
	  			, 	'</var>'
	  			,'</li>';
		}
	}
?>