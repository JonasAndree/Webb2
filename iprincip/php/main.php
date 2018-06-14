

<div class='square square-header'>
	<div class="container pressable"
		onclick="setView('showstationrecords')">
		<p>Stationrecords</p>
	</div>
</div>
<div class='square square-header'>
	<div class="container pressable" onclick="showGraph('design')">
		<p>Designe</p>
	</div>
</div>
<div class='square square-header'>
	<div class="container pressable" onclick="showGraph('showtemperature'); animateArrow(21.2);">
		
		<div class="termostat">
    		<div class="roundSquare"></div>
    		<div class="dot"></div>
    		<div class="topDot"></div>
    		<div class="topInsideDot"></div>
    		<div class="insideRoundSquare"></div>
    		<div class="insideDot"></div>
    		<div id="tempValue" class="tempValue"></div>
    		<div id="tempDot" class="tempDot"></div>
		</div>
		
    	<p class='square-header bottom2'><font color="yellow">21.2 ℃</font></p>
	</div>
</div>
<?php
?>