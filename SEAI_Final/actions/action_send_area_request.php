<?php

include_once('../config/init.php');

  
$result=getRequestInfo($_SESSION["r_id"]);

$areas = $result['area_polygon'];


print json_encode($areas);


//header("Location: $BASE_URL". '/pages/show_previous_data.php');

?>
