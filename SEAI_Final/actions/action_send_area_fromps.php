<?php

include_once('../config/init.php');

  
$result=getAllStoredAreas();

$areas = array();

for ($x = 0; $x <= sizeof($result)-1; $x++) {
	$areas[$x]=$result[$x]["area_polygon"]; 
}

print json_encode($areas);


//header("Location: $BASE_URL". '/pages/show_previous_data.php');

?>
