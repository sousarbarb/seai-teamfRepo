<?php

include_once('../config/init.php');
	$pr=1;
	 if($_POST['restrict']==1){
		 $pr=0;
	 }


	$result=newRequestForNewData($_SESSION["area"], $_SESSION["login"], $_POST['sensor'], $_POST['resolution'], $_POST['eday'], $_POST['comment'], $pr);
	if($result==-1) {
		$_SESSION['error_messages'][] = 'This user isnt regsitered in the platform';
		die(header("Location: $BASE_URL". '/pages/plan_new_mission.php'));
	}
	elseif($result==-2) {
		$_SESSION['error_messages'][] = 'This account is not active';
		die(header("Location: $BASE_URL". '/pages/plan_new_mission.php'));
	}
	elseif($result==-3) {
		$_SESSION['error_messages'][] = 'The selected sensor type no longer exists';
		die(header("Location: $BASE_URL". '/pages/plan_new_mission.php'));
	}
	elseif($result==-4) {
		$_SESSION['error_messages'][] = 'The selected Resolution type no longer exists';
		die(header("Location: $BASE_URL". '/pages/plan_new_mission.php'));
	}
	elseif($result==-5) {
		$_SESSION['error_messages'][] = 'The selected sensor type and  Resolution type does not exist';
		die(header("Location: $BASE_URL". '/pages/plan_new_mission.php'));
	}
	elseif($result==-6) {
		$_SESSION['error_messages'][] = 'The Deadline format is not valid';
		die(header("Location: $BASE_URL". '/pages/plan_new_mission.php'));
	}
	elseif($result==-7) {
		$_SESSION['error_messages'][] = 'The Deadline format is not valid';
		die(header("Location: $BASE_URL". '/pages/plan_new_mission.php'));
	}
	elseif($result==-8) {
		$_SESSION['error_messages'][] = 'The selected area is Null';
		die(header("Location: $BASE_URL". '/pages/plan_new_mission.php'));
	}
	elseif($result==-9) {
		$_SESSION['error_messages'][] = 'The selected area doesn t have 3 vertices';
		die(header("Location: $BASE_URL". '/pages/plan_new_mission.php'));
	}
	elseif($result==-10) {
		$_SESSION['error_messages'][] = 'Inserting the new area was not possible';
		die(header("Location: $BASE_URL". '/pages/plan_new_mission.php'));
	}
	elseif($result==-11) {
		$_SESSION['error_messages'][] = 'Inserting the new request was not possible';
		die(header("Location: $BASE_URL". '/pages/plan_new_mission.php'));
	}
	elseif($result==-12) {
		$_SESSION['error_messages'][] = "There aren't any Service Providers that can fulfill this request";
		die(header("Location: $BASE_URL". '/pages/plan_new_mission.php'));
	}
	elseif($result==-20) {
		$_SESSION['error_messages'][] = 'The selected area must be on the ocean';
		die(header("Location: $BASE_URL". '/pages/plan_new_mission.php'));
	}
	else{
		$_SESSION['success_messages'][] = 'Request was created Successfully';
		die(header("Location: $BASE_URL". '/pages/plan_new_mission.php'));
	}

?>
