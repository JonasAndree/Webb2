<!DOCTYPE html>
<html>
	<head>
		<title>Jonas Rep</title>
		<link rel="stylesheet" type="text/css" href="css/inventory.css"/>
	</head>
	<body>
	
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
	</body>
</html>