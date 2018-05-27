<!DOCTYPE html>
<html>
	<head>
		<title>Jonas Rep</title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		
		<link rel="stylesheet" type="text/css" href="css/inventory.css"/>
		<link rel="stylesheet" type="text/css" href="css/media.css"/>
		<link rel="stylesheet" type="text/css" href="css/login.css"/>
		
    	<script src="js/build/three.js"></script>
		<script src="js/Detector.js"></script>
		<script src="js/controls/OrbitControls.js" on></script>
		
		
		<!-- <script src="js/libs/inflate.min.js"></script>
		 -->
		 
	</head>
	<body>
		<main id="main">
        	<div id="canvas" ></div>
    	
        	<header id="header">
        		<div id="heading"><p> HTML CSS PHP JavaScript Ajax mySQL Three.js</p></div>
        		<div id = "login-container">
            		<div id = "login-content">	
                		<div id="login">
                			
                		</div>
                		<div id="register">
                			
                		</div>
            		</div>
        		</div>		
        	</header>
        
    		<div id="active-gear">
				<?php 
    				include "php/createInventory.php";
                ?>
    		</div>
    		
    		<button id="toggle-view" onclick="scrollToView();">&#x21F3</button>
    		
    		<div id="storage">
    			<?php include "php/storage.php" ?>
    		</div>
		</main>
		<section id="delete-screen">
			<div id="delete-container">
				<div id="delete-content">
					<header id="delete-heading">Delete?</header>
					<p id="delete-text">Are you sure you would like to delete that item?</p>
					<button id="cancel-delete-button" class="delete-button" onclick="deleteItem('cancel')">Cancel</button>
					<button id="delete-button" class="delete-button" onclick="deleteItem('delete')">Delete</button>
				</div>
			</div>
		</section>
		<script type="text/javascript" src="js/inventory.js"></script>
		<script type="text/javascript" src="js/canvasView.js"></script>
	</body>
</html>