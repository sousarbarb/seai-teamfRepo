<?php

include_once('../config/init.php');


//$id_r = $_POST['check'];



if (isset($_POST['back'])) {
	header("Location: $BASE_URL" . '/pages/map.php');
    }
 elseif (isset($_POST['confirm'])) {
	if(!$result) {
		echo "There is an error!";
	}
   //header("Location: $BASE_URL" .'/pages/users/user_management.php');
    }

else{
	header("Location:  $BASE_URL" . '/pages/show_previous_data.php');
}	
?>