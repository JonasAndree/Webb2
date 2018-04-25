<!DOCTYPE html>
<html>
    <body>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>
        
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $serverName = "localhost";
                $userName = "root";
                $serverPassword = "";
                $dbName = "tek15";
                
                // Create connection
                $conn = new mysqli($serverName, $userName, $serverPassword, $dbName) or die(mysql_error);
            	
            	$id = $_POST["id"];
            	echo $id,'<br>';
            	
            	// File properties
            	$file = $_FILES['fildata']['tmp_name'];	//
            	echo $file = $_FILES['fildata']['tmp_name'],'<br>';
            	
            	if(!isset($file)) {
            		echo "please select an file.<br>";
            		echo "<br>det ar ok<br>";
            	} else {
            		// Gives the content of the file that is to be upploaded.
            		$image = addslashes(file_get_contents($_FILES['fildata']['tmp_name']));
            		// Gives the name of the file that is to be uploaded.
            		//echo $image_name = addslashes($_FILES['fildata']['name']);	
            		// Gives the size of the file to for controling if the file was uploaded
            		$image_size = getimagesize($_FILES['fildata']['tmp_name']); 
            	
            		if($image_size == false){
            			echo "that's not file",'<br>';
            		} else {
            			echo "that's a file<br>";
            			$users = $conn->query("SELECT * FROM userinfo");
            			while($row = $users->fetch_assoc()){
            				echo var_dump(htmlspecialchars($row["mail"])),' : ',var_dump(htmlspecialchars($id)),'<br>';
            				
            				if($row["mail"] == $id){
            					$mail = $row["mail"];
            					$conn->query("UPDATE userinfo SET image='$image' WHERE mail='$mail'");
            					echo "<br> The uploading went well! <br>";
            					
            					$users2 = $conn->query("SELECT * FROM userinfo");
            					while($row = $users2->fetch_assoc()){
            						if($row["mail"] == $id){
            							$imageEncoded = base64_encode($row["image"]);
            							echo '<script type="text/javascript">'
            									, 'localStorage.setItem("imageChanged", "true");'
            									, 'localStorage.setItem("userImage", "'.$imageEncoded.'");'
            									, '</script>';
            						}
            					}
            				}
            			}
            		}
            	}
            	echo "database closed";
            	$conn->close();
            	
            	//echo '<img id="u-img" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>';
            	//echo "$image";
            	echo "<script>window.close();</script>";
            }
            
        ?>
    </body>
</html>