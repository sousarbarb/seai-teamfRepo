<?php
include_once('../config/init.php');

$return = serviceClientAcceptMission($_POST['request_id'], $_POST['mission_id'], $smarty->getTemplateVars('login'), $_POST['provider_id']);

$_SESSION['success_messages'][]="New proposal successfully accepted";
die(header('Location: ' . $_SERVER['HTTP_REFERER']));
?>
