<?php
include_once('../config/init.php');

$return = serviceClientIgnoreMission($_POST['request_id'], $_POST['mission_id'], $_POST['provider_id']);

$_SESSION['success_messages'][]="New proposal successfully ignored";
die(header('Location: ' . $_SERVER['HTTP_REFERER']));
?>
