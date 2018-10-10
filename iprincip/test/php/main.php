

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
    
    $conn = new mysqli("localhost", "root", "", "iprincip.nu");
    if ($conn->connect_error) {
        die("<div id='failed'>Connection failed: " . $conn->connect_error . "<div><br>");
    } 
    
    $users = $conn->query("SELECT MAX(Temp) FROM `temperaturs` WHERE Timestamp = '2018-06-14 21:12:08'");
    $user_array = $users->fetch_assoc();
    $today = round(reset($user_array), 1);
    
    
    $conn->close();
    addTermo($today, "Temperature now");
    
    
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
                        if (floatval($value) > 0) {
                            echo "<div style='height: ".((floatval($value) + 30)/1.5)."px ; background-color: rgb(". (200 + floatval($value)*2) . ", 0, 0);  ' class='tempValue'></div>
                                  <div style='background-color: rgb(". (200 + floatval($value)*2) . ", 0,0);  ' class='tempDot'></div>

                                  <div style='bottom: ".(((floatval($value) + 30)/1.5) + 20)."px;' class='tempLine'>
                                     <p class='front-value pos'>$value ℃</p>
                                  </div>";
                        } else {
                            echo "<div style='height: ".((floatval($value) + 30)/1.5)."px ; background-color: rgb(0, 0, ". (200 - floatval($value)*2) . ");  ' class='tempValue'></div>
                                  <div style='background-color: rgb(0,0, ". (200 - floatval($value)*2) . ");  ' class='tempDot'></div>

                                  <div style='bottom: ".(((floatval($value) + 30)/1.5) + 20)."px;' class='tempLine'>
                                       <p class='front-value mon'>$value ℃</p>
                                  </div>";
                        }
                    echo "
                </div>
            </div>
        </div>
        ";
    }
?>