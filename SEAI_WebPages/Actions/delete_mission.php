<?php
  include_once('../config/init.php');

		$mission_id = $_GET['mission_id'];
		$provider_id = $smarty->getTemplateVars('user_id');
		$result = updateMissionStatus($mission_id, $mission_status='refused');
		die (header("Location: ../pages/menu_requests_waiting.php"));

?>