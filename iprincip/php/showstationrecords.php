<div class='square'>
    <div class="container pressable" onclick="setView('home')">
    	<img class='back-img' alt='back arrow' src='./images/backarrow.png'>
    </div>
</div>
<?php

    addCard($heading="Temperaturrekord", $imgAlt="Max temperture", $src="./images/maxtemperaturered.png",
        $headingBottom="Max", $value="30.9", $date="2018-06-03 16:45", $color="warm");
    
    addCard($heading="Temperaturrekord", $imgAlt="Min temperture", $src="./images/mintemperatureblue.png",
        $headingBottom="Min", $value="-18.7", $date="2017-01-06 04:25", $color="cold");
    
    addCard($heading="Dagens temperatur", $imgAlt="Max temperture", $src="./images/hogstatemperaturered.png",
        $headingBottom="Högsta", $value="21.6", $date="16:45", $color="warm");
    
    addCard($heading="Dagens temperatur", $imgAlt="Min temperture", $src="./images/lagstatemperature.png",
        $headingBottom="Lägsta", $value="7.6", $date="04:00", $color="cold");
    
    addCard($heading="Gårdagens temperatur", $imgAlt="Max temperture", $src="./images/hogstatemperaturered.png",
        $headingBottom="Högsta", $value="26.9", $date="16:30", $color="warm");
    
    addCard($heading="Gårdagens temperatur", $imgAlt="Min temperture", $src="./images/lagstatemperature.png",
        $headingBottom="Lägsta", $value="6.8", $date="04:15", $color="cold");
    
    addCard($heading="Ett år sedan", $imgAlt="Max temperture", $src="./images/hogstatemperaturered.png",
        $headingBottom="Högsta", $value="16.9", $date="12:55", $color="warm");
    
    addCard($heading="Ett år sedan", $imgAlt="Min temperture", $src="./images/lagstatemperature.png", 
        $headingBottom="Lägsta", $value="8.3", $date="03:30", $color="cold");
    
    function addCard($heading, $imgAlt, $src, $headingBottom, $value, $date, $color){
        echo "<div class='square scene scene--card pressable'>
                <div class='card' onclick='flip(this)'>
                    <div class='card__face card__face--front'>
                        <p class='square-small-header top'>$heading</p>
                        <p class='front-value'>$value ℃</p>
                        <img class='temperture-img' alt='$imgAlt' src='$src'>
    				    <p class='square-small-header bottom'>$headingBottom</p>
    			     </div>
    		         <div class='card__face card__face--back $color'>
    				    <p class='square-small-header top'>$heading</p>
    				    <p>$value<br>℃</p>
    				    <p class='sub-heading'>$date</p>
    				 </div>
    			</div>
    		</div>";
    }
?>