<?php

include_once('../config/init.php');
//$req = json_decode($_POST['iarea'],true);
//print_r($req);

if(isset($_SESSION["area"])){
print json_encode($_SESSION["area"]);
}
else{
	echo "0";
}
//header("Location: $BASE_URL". '/pages/show_previous_data.php');
?>
