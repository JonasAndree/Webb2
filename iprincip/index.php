<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <link rel="stylesheet" type="text/css" href="css/media.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
    <body>
    	<header id="top-header" onclick="setView('home')">
    		iPrincip.nu
    	</header>
    	
    	<main id="main">
        	<section id="home">
    			<?php include "php/main.php" ?>
    		</section>
    		<section id="showstationrecords">
    			<?php include "php/showstationrecords.php" ?>
    		</section>
    		
    		<section id="graph">
    			<div id="design"> 
    				<div class="graph">
    					<div class="graph-background pressable" onclick="hideGraph('design')"></div>
    					<div class="graph-image-container" >
        					<div class="graph-exit pressable" onclick="hideGraph('design')">
        					  	<div class="menu-bar-1"></div>
        					  	<div class="menu-bar-2"></div>
        					</div>
        					<img class="graph-images" alt="Configuration.png" src="images/Configuration.png">
    					</div>
    				</div>
    			</div>
    			<div id="showtemperature"> 
    				<div class="graph">
    					<div class="graph-background pressable" onclick="hideGraph('showtemperature')"></div>
    					<div class="baromter-image-container" >
        					<img class="baromter-images" alt="baromter.png" src="images/baromter.png">
        					<img id="arrow" class="baromter-images" alt="arrow.png" src="images/arrow.png">
    					</div>
    				</div>
    			</div>
    			
    		</section>
    	</main>
    	
    	
    	<script type="text/javascript" src="js/main.js"></script>
    </body>
</html>

