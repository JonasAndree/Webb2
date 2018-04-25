<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/lesson.css"/>
	</head>
    <body>
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>
        
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $serverName = "localhost";
                $serverUserName = "root";
                $serverPassword = "";
                $dbName = "tek15";
                $uploadOk = 1;
                $currentUserMail = "jonandre@kth.se";
                
                // Create connection
                $conn = new mysqli($serverName, $serverUserName, $serverPassword, $dbName);
            	            	// File properties
                $file = $_FILES['fileToUpload']['tmp_name'];	//
            	$fileType;
            	
            	// Check if image file is a actual image or fake image
            	if(isset($_POST["submit"])) {
            	    $check = getimagesize($file);
            	    if($check !== false) {
            	        $fileType = $check["mime"];
            	        echo "File is an image - " . $fileType . ".";
            	    } else {
            	        echo "File is not an image.<br>";
            	        $upladOk = 0;
            	    }
            	}
            	// Check file size
            	if ($_FILES["fileToUpload"]["size"] > 500000) {
            	    echo "Sorry, your file is too large.";
            	    $uploadOk = 0;
            	} 
            	// Check file is to be upploaded 
            	if ($uploadOk == 0) {
            	    echo "Upploading file faild!";
            	} else {
            		// Gives the content of the file that is to be upploaded.
            	    $image = addslashes(file_get_contents($file));
            	    $imageName = $_FILES['fileToUpload']['name'];	//
            	    
            	    $conn->query("UPDATE `users` SET imageContent='$image', imageName='$imageName', imageType='$fileType' WHERE mail='$currentUserMail'");
					echo "<br> The uploading went well! <br>";
            		
					
					$sql = "SELECT * FROM `users` WHERE mail='$currentUserMail'";
					$result = $conn->query($sql);
					$row = $result->fetch_assoc();
					$imageContent = $row["imageContent"];
					$imageType = $row["imageType"];
					$imageName = $row["imageName"];
					
					echo "<embed src='data:".$imageType.";base64,".base64_encode($imageContent)."' width='200'/>";
            	}
            	echo "<br>Database closed.<br>";
            	$conn->close();
            	
            }
        ?>
    </body>
</html>