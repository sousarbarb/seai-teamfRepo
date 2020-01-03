<?php

include_once('../config/init.php');


if (isset($_POST['back'])) {
	header("Location: $BASE_URL" . 'pages/map.php');
    }
   //header("Location: $BASE_URL" .'/pages/users/user_management.php');
	elseif (isset($_POST['Plan'])) {
			header("Location:  $BASE_URL" . 'pages/plan_new_mission.php');
	}

else{
	$_SESSION["r_id"]=$_POST['rid'];
	echo $_SESSION["r_id"];
	//header("Location:  $BASE_URL" . 'pages/show_previous_data.php');
}
?>
