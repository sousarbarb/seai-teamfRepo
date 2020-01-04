<?php

include_once('../config/init.php');


if (isset($_POST['back'])) {
	header("Location: $BASE_URL" . 'pages/map.php');
    }
   //header("Location: $BASE_URL" .'/pages/users/user_management.php');
	elseif (isset($_POST['Plan'])) {
			header("Location:  $BASE_URL" . 'pages/plan_new_mission.php');
	}
	elseif (isset($_POST['buy'])) {
			$res = $_POST['check'];
			//echo $id;
			$pieces = explode(",", $res);
			$id=$pieces[0];
			$mid=$pieces[1];
			$result=newRequestOldData($_SESSION["login"],$mid);
		if($result==-1) {
			$_SESSION['error_messages'][] = 'This user isnt regsitered in the platform';
			die(header("Location: $BASE_URL". '/pages/show_previous_data.php'));
		}
		elseif($result==-2) {
			$_SESSION['error_messages'][] = 'This account is not active';
			die(header("Location: $BASE_URL". '/pages/show_previous_data.php'));
		}
		elseif($result==-3) {
			$_SESSION['error_messages'][] = 'The Mission ID isnt valid';
			die(header("Location: $BASE_URL". '/pages/show_previous_data.php'));
		}
		elseif($result==-4) {
			$_SESSION['error_messages'][] = 'The mission has yet to be concluded';
			die(header("Location: $BASE_URL". '/pages/show_previous_data.php'));
		}
		elseif($result==-5) {
			$_SESSION['error_messages'][] = 'The data acquired in the mission is restricted to the service client who requested it';
			die(header("Location: $BASE_URL". '/pages/show_previous_data.php'));
		}
		elseif($result==-6) {
			$_SESSION['error_messages'][] = 'The area related to the mission of acquiring data was not founded';
			die(header("Location: $BASE_URL". '/pages/show_previous_data.php'));
		}
		elseif($result==-7) {
			$_SESSION['error_messages'][] = 'Inserting the new request was not possible';
			die(header("Location: $BASE_URL". '/pages/show_previous_data.php'));
		}
		elseif($result==-8) {
			$_SESSION['error_messages'][] = 'It was not possible to link the request to the mission in question';
			die(header("Location: $BASE_URL". '/pages/show_previous_data.php'));
		}
		else{ 
			$_SESSION['success_messages'][] = 'Operation concluded with success;';
			die(header("Location: $BASE_URL". '/pages/show_previous_data.php'));
		}
			//echo $pieces[1];
			//header("Location:  $BASE_URL" . 'pages/plan_new_mission.php');
	}

else{
	$_SESSION["r_id"]=$_POST['rid'];
	//echo $_SESSION["r_id"];
	header("Location:  $BASE_URL" . 'pages/request_pag.php');
}
?>
