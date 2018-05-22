<html>
    <head>
   		<link rel="stylesheet" type="text/css" href="css/inventory.css"/>
	</head>
	<body>
		<script src="js/build/three.min.js"></script>
		<script src="js/libs/inflate.min.js"></script>
		
		<script src="js/controls/OrbitControls.js"></script>

		<script src="js/Detector.js"></script>
		
		<script src="js/loaders/JSONLoader.js"></script>
		<div id="canvas" ></div>
		<div id="subitems-container"></div>
        <?php include "php/setMainItems.php"; ?>
        
        <div id="bag">
        	<?php include "php/bag.php"; ?>
        </div>
        <div id="stats-container">
    		<?php include "php/setStats.php";?>
		</div>
        <script type="text/javascript" src="js/inventory.js"></script>
        <!--  <script type="text/javascript" src="js/3DCharacter.js"></script>-->
        <script type="text/javascript" src="js/character.js"></script>
	</body>
</html>