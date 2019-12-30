<?php

include_once('../config/init.php');

$result1 =' POLYGON((-8.6870 41.1715,-8.6840 41.1715,-8.6840 41.1700,-8.6870 41.1700,-8.6870 41.1715))';
  
 $result2 =' POLYGON((-9.6870 41.1715,-9.6840 41.1715,-9.6840 41.1700,-9.6870 41.1700,-9.6870 41.1715))'; 
  
$result =array($result1,$result2);


print json_encode($result);


//header("Location: $BASE_URL". '/pages/show_previous_data.php');

?>
