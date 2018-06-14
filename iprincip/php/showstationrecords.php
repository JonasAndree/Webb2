<div class='square'>
    <div class="container pressable" onclick="setView('home')">
    	<img class='back-img' alt='back arrow' src='./images/backarrow.png'>
    </div>
</div>
<?php

    addCard($heading="Temperature record", $imgAlt="Max temperture", $src="./images/maxtemperaturered.png",
        $headingBottom="Max", $value="30.9", $date="2018-06-03 16:45", $color="warm");
    
    addCard($heading="Temperature record", $imgAlt="Min temperture", $src="./images/mintemperatureblue.png",
        $headingBottom="Min", $value="-18.7", $date="2017-01-06 04:25", $color="cold");
    
    addCard($heading="Todays temperatur", $imgAlt="Max temperture", $src="./images/hogstatemperaturered.png",
        $headingBottom="Högsta", $value="21.6", $date="16:45", $color="warm");
    
    addCard($heading="Todays temperatur", $imgAlt="Min temperture", $src="./images/lagstatemperature.png",
        $headingBottom="Lägsta", $value="7.6", $date="04:00", $color="cold");
    
    addCard($heading="Yesterday's temperature", $imgAlt="Max temperture", $src="./images/hogstatemperaturered.png",
        $headingBottom="Högsta", $value="26.9", $date="16:30", $color="warm");
    
    addCard($heading="Yesterday's temperature", $imgAlt="Min temperture", $src="./images/lagstatemperature.png",
        $headingBottom="Lägsta", $value="6.8", $date="04:15", $color="cold");
    
    addCard($heading="One year ago", $imgAlt="Max temperture", $src="./images/hogstatemperaturered.png",
        $headingBottom="Högsta", $value="16.9", $date="12:55", $color="warm");
    
    addCard($heading="One year ago", $imgAlt="Min temperture", $src="./images/lagstatemperature.png", 
        $headingBottom="Lägsta", $value="8.3", $date="03:30", $color="cold");
    
    function addCard($heading, $imgAlt, $src, $headingBottom, $value, $date, $color){
        echo "<div class='square scene scene--card pressable'>
                <div class='card' onclick='flip(this)'>
                    <div class='card__face card__face--front'>
                        <p class='square-small-header top'>$heading</p>
                        <div class='termostat'>
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
                                echo "<div style='height: ".((floatval($value) + 30)/1.5)."px ; background-color: rgb(". (150 + floatval($value)*7) . ", 0, 0);  ' class='tempValue'></div>
                        		      <div style='background-color: rgb(". (150 + floatval($value)*7) . ", 0,0);  ' class='tempDot'></div>";
                		    } else {
                		        echo "<div style='height: ".((floatval($value) + 30)/1.5)."px ; background-color: rgb(0, 0, ". (150 + floatval($value)*3) . ");  ' class='tempValue'></div>
                        		      <div style='background-color: rgb(0,0, ". (150 + floatval($value)*3) . ");  ' class='tempDot'></div>";
                		    }
                            
                        echo " 
                            <div style='bottom: ".(((floatval($value) + 30)/1.5) + 20)."px;' class='tempLine'>
                                <p class='front-value'>$value ℃</p>
                            </div>
                        </div>
    				    <p class='square-small-header bottom'>$headingBottom</p>
    			     </div>";
                        if (floatval($value) > 10) {
                            echo "<div style='background-color: rgb(". (100 + floatval($value)*2) . ", 0,0);  ' class='card__face card__face--back'>";
                        } else {
                            echo "<div style='background-color: rgb(0,0, ". (100 + floatval($value)*2) . ");  ' class='card__face card__face--back'>";
                        }
    		         echo "
    				    <p class='square-small-header top'>$heading</p>
    				    <p>$value<p class='cel-sice'>℃</p></p>
    				    <p class='sub-heading'>$date</p>
    				 </div>
    			</div>
    		</div>";
    }
?>