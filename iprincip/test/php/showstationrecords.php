<div class='square'>
    <div class="container pressable" onclick="setView('home')">
    	<img class='back-img' alt='back arrow' src='./images/backarrow.png'>
    </div>
</div>
<?php
    $today = "2018-06-14";
    $conn = new mysqli("localhost", "root", "", "iprincip.nu");
    if ($conn->connect_error) {
        die("<div id='failed'>Connection failed: " . $conn->connect_error . "<div><br>");
    } else {
    }
    $users = $conn->query("SELECT MAX(Temp), Timestamp FROM `temperaturs`");
    $user_array = $users->fetch_assoc();
    $max = round(reset($user_array), 1);
    
    $maxTime = $user_array["Timestamp"];
    
    $users = $conn->query("SELECT MIN(Temp), Timestamp FROM `temperaturs`");
    $user_array = $users->fetch_assoc();
    $min = round(reset($user_array), 1);
    $minTime = $user_array["Timestamp"];
    
    $users = $conn->query("SELECT MAX(Temp), Timestamp FROM `temperaturs` WHERE Timestamp > DATE_SUB(NOW(), INTERVAL 1 DAY)");
    $user_array = $users->fetch_assoc();
    $todayMax = round(reset($user_array), 1);
    $todayMaxTime = $user_array["Timestamp"];
    
    $users = $conn->query("SELECT MIN(Temp), Timestamp FROM `temperaturs` WHERE Timestamp > DATE_SUB(NOW(), INTERVAL 1 DAY)");
    $user_array = $users->fetch_assoc();
    $todayMin = round(reset($user_array), 1);
    $todayMinTime = $user_array["Timestamp"];
    
    $users = $conn->query("SELECT MAX(Temp), Timestamp FROM `temperaturs` WHERE Timestamp > DATE_SUB(NOW(), INTERVAL 7 DAY)");
    $user_array = $users->fetch_assoc();
    $yesturdayMax = round(reset($user_array), 1);
    $yesturdayMaxTime = $user_array["Timestamp"];
    
    $users = $conn->query("SELECT MIN(Temp), Timestamp FROM `temperaturs` WHERE Timestamp > DATE_SUB(NOW(), INTERVAL 7 DAY)");
    $user_array = $users->fetch_assoc();
    $yesturdayMin = round(reset($user_array), 1);
    $yesturdayMinTime = $user_array["Timestamp"];

    $users = $conn->query("SELECT MAX(Temp), Timestamp FROM `temperaturs` WHERE Timestamp > DATE_SUB(NOW(), INTERVAL 1 YEAR)");
    $user_array = $users->fetch_assoc();
    $yearMax = round(reset($user_array), 1);
    $yearMaxTime = $user_array["Timestamp"];
    
    $users = $conn->query("SELECT MIN(Temp), Timestamp FROM `temperaturs` WHERE Timestamp > DATE_SUB(NOW(), INTERVAL 1 YEAR)");
    $user_array = $users->fetch_assoc();
    $yearMin = round(reset($user_array), 1);
    $yearMinTime = $user_array["Timestamp"];
    
    
    $conn->close();

    addCard($heading="Temperature record", $imgAlt="Max temperture", $src="./images/maxtemperaturered.png",
        $headingBottom="Max", $value="$max", $date="$maxTime", $top="top");
    
    addCard($heading="Temperature record", $imgAlt="Min temperture", $src="./images/mintemperatureblue.png",
        $headingBottom="Min", $value="$min", $date="$minTime", $top="top");
    
    addCard($heading="Todays temperatur", $imgAlt="Max temperture", $src="./images/hogstatemperaturered.png",
        $headingBottom="Max", $value="$todayMax", $date="$todayMaxTime", $top="top");
    
    addCard($heading="Todays temperatur", $imgAlt="Min temperture", $src="./images/lagstatemperature.png",
        $headingBottom="Min", $value="$todayMin", $date="$todayMinTime", $top="top");
    
    addCard($heading="Yesterday's temperature", $imgAlt="Max temperture", $src="./images/hogstatemperaturered.png",
        $headingBottom="Max", $value="$yesturdayMax", $date="$yesturdayMaxTime", $top="top2");
    
    addCard($heading="Yesterday's temperature", $imgAlt="Min temperture", $src="./images/lagstatemperature.png",
        $headingBottom="Min", $value="$yesturdayMin", $date="$yesturdayMinTime", $top="top2");
    
    addCard($heading="One year ago", $imgAlt="Max temperture", $src="./images/hogstatemperaturered.png",
        $headingBottom="Max", $value="$yearMax", $date="$yearMaxTime", $top="top");
    
    addCard($heading="One year ago", $imgAlt="Min temperture", $src="./images/lagstatemperature.png", 
        $headingBottom="Min", $value="$yearMin", $date="$yearMinTime", $top="top");
    
    function addCard($heading, $imgAlt, $src, $headingBottom, $value, $date, $top){
        echo "<div class='square scene scene--card pressable'>
                <div class='card' onclick='flip(this)'>
                    <div class='card__face card__face--front'>

                        <p class='square-small-header $top'>$heading</p>

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
                            if (floatval($value) > 0) {
                                echo "<div style='height: ".((floatval($value) + 30)/1.5)."px ; background-color: rgb(". (150 + floatval($value)*7) . ", 0, 0);  ' class='tempValue'></div>
                        		      <div style='background-color: rgb(". (150 + floatval($value)*7) . ", 0,0);  ' class='tempDot'></div>
                                        
                                      <div style='bottom: ".(((floatval($value) + 30)/1.5) + 20)."px;' class='tempLine'>
                                          <p class='front-value pos'>$value ℃</p>
                                      </div>";
                		    } else {
                		        echo "<div style='height: ".((floatval($value) + 30)/1.5)."px ; background-color: rgb(0, 0, ". (150 + floatval($value)*3) . ");  ' class='tempValue'></div>
                        		      <div style='background-color: rgb(0,0, ". (150 + floatval($value)*3) . ");  ' class='tempDot'></div>
                                        
                                      <div style='bottom: ".(((floatval($value) + 30)/1.5) + 20)."px;' class='tempLine'>
                                          <p class='front-value min'>$value ℃</p>
                                      </div>";
                		    }
                            
                        echo " 
                        </div>
    				    <p class='square-small-header bottom'>$headingBottom</p>
    			     </div>";
                        if (floatval($value) > 0) {
                            echo "<div style='background-color: rgb(". (120+(floatval($value))*5) . ", 0,0);  ' class='card__face card__face--back'>";
                        } else {
                            echo "<div style='background-color: rgb(0,0, ". ((floatval($value)+30)*10) . ");  ' class='card__face card__face--back'>";
                        }
    		         echo "
    				    <p class='square-small-header $top'>$heading</p>
    				    <p>$value<p class='cel-sice'>℃</p></p>
    				    <p class='sub-heading'>$date</p>
    				 </div>
    			</div>
    		</div>";
    }
?>