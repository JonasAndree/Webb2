

<div class='square square-header'>
	<div class="container pressable"
		onclick="setView('showstationrecords')">
		<p>Station records</p>
	</div>
</div>
<div class='square square-header'>
	<div class="container pressable" onclick="showGraph('design')">
		<p>Design</p>
	</div>
</div>
<?php
    $value = 21.2;
    addTermo($value, "Temperature now");
    function addTermo($value, $heading) {
        echo "
            <div class='square square-header'>
    	       <div class='container pressable' onclick='showGraph(\"showtemperature\"); animateArrow($value);'>
                    <p class='square-small-header top'>$heading</p>
                    <div class='termostat mainTermo'>
                        <div class='lines'>
                            <div class='line'></div>
                            <div class='line'></div>
                            <div class='line'></div>
                            <div class='line'></div>
                            <div class='line'></div>
                            <div class='line'></div>
                            <div class='line'></div>
                            <div class='lineDot'></div>
                        </div>
                        <div class='roundSquare'></div>
                        <div class='dot'></div>
                        <div class='topDot'></div>
                        <div class='topInsideDot'></div>
                        <div class='insideRoundSquare'></div>
                        <div class='insideDot'></div>";
                        if (floatval($value) > 10) {
                            echo "<div style='height: ".((floatval($value) + 30)/1.5)."px ; background-color: rgb(". (200 + floatval($value)*2) . ", 0, 0);  ' class='tempValue'></div>
                                  <div style='background-color: rgb(". (200 + floatval($value)*2) . ", 0,0);  ' class='tempDot'></div>";
                        } else {
                            echo "<div style='height: ".((floatval($value) + 30)/1.5)."px ; background-color: rgb(0, 0, ". (200 - floatval($value)*2) . ");  ' class='tempValue'></div>
                                  <div style='background-color: rgb(0,0, ". (200 - floatval($value)*2) . ");  ' class='tempDot'></div>";
                        }
                    echo "<div style='bottom: ".(((floatval($value) + 30)/1.5) + 20)."px;' class='tempLine'>
                        <p class='front-value'>$value ℃</p>
                    </div>
                </div>
            </div>
        </div>
        ";
    }
?>