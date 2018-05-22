<!DOCTYPE html>
<html>
	<head>
		<title>Jonas Rep</title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		
		<link rel="stylesheet" type="text/css" href="css/inventory.css"/>
		
    	<script src="js/build/three.js"></script>
		<script src="js/Detector.js"></script>
		<script src="js/controls/OrbitControls.js"></script>
		
		
		<!-- <script src="js/libs/inflate.min.js"></script>
		<script src="js/controls/OrbitControls.js"></script>
		<script src="js/loaders/JSONLoader.js"></script>
		 -->
		 
	</head>
	<body>
	
	
	
    	<header id="header">
    		<div id="loggin"> </div>
    	</header>
    	
    	<div id="canvas" ></div>
    	
    	
    	
	
		<div id="active-gear">
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
		
		
		<div id="bag">
			<?php include "php/bag.php" ?>
		</div>
		
		<script type="text/javascript" src="js/inventory.js"></script>
		<script type="text/javascript" src="js/canvasView.js"></script>
	</body>
</html>