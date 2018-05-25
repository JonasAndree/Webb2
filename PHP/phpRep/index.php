<!DOCTYPE html>
<html>
	<head>
		<title>Jonas Rep</title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		
		<link rel="stylesheet" type="text/css" href="css/inventory.css"/>
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
                			<?php include "php/login.php" ?>
                		</div>
                		<div id="register">
                			<?php include "php/register.php" ?>
                		</div>
            		</div>
        		</div>		
        	</header>
        
    		<div id="active-gear">
    			<div id="armor-arrow" class="arrow left"onclick="showArmor('armor-arrow', 'armor-container')" > 
    				<img class="arrow-img" alt="tap your mouse here to show content" src="images/tap.png">
    			</div>
        		<div id="armor-container">
        			<div class="armor-column">
                		<div id="head-gear">
            				<?php
                				$subtype = "head";
                				$direction = "left";
            				    include "php/addActiveGear.php"; 
                            ?>
                		</div>
                		<div id="cheast-gear">
            				<?php 
                				$subtype = "cheast";
                				$direction = "left";
                				include "php/addActiveGear.php";
                            ?>
                		</div>
                		<div id="arms-gear">
            				<?php 
                				$subtype = "arms";
                				$direction = "left";
                				include "php/addActiveGear.php";
                            ?>
                		</div>
                		<div id="leggs-gear">
            				<?php 
                				$subtype = "leggs";
                				$direction = "left";
                				include "php/addActiveGear.php";
                            ?>
                		</div>
                		<div id="cape-gear">
            				<?php 
                				$subtype = "cape";
                				$direction = "left";
                				include "php/addActiveGear.php";
                            ?>
                		</div>
            		</div>
        		</div>
        		
    			<div id="wpn-arrow" class="arrow right" onclick="showArmor('wpn-arrow', 'wpn-container')" > 
    				<img id="right-arrow-img" class="arrow-img" alt="tap your mouse here to show content" src="images/tap.png">
    			</div>
        		<div id="wpn-container">
        			<div class="wpn-column">
                		<div id="light-gear">
            				<?php 
                				$subtype = "light";
                				$direction = "right";
                				include "php/addActiveGear.php";
                            ?>
                		</div>
                		<div id="medium-gear">
            				<?php 
                				$subtype = "medium";
                				$direction = "right";
                    			include "php/addActiveGear.php";
                            ?>
                		</div>
                		<div id="heavy-gear">
            				<?php 
                				$subtype = "heavy";
                				$direction = "right";
                				include "php/addActiveGear.php";
                            ?>
                		</div>
                	</div>	
    			</div>
    		</div>
    		
    		<button id="toggle-view" onclick="scrollToView();">&#x21F3</button>
    		
    		<div id="bag">
    			<?php include "php/bag.php" ?>
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