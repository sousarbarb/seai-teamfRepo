<?php
include_once('../config/init.php');

$service_provider = getServiceProviderInformation($smarty->getTemplateVars('login'));

if (empty($service_provider)) {
  $_SESSION['error_messages'][]="Could not get provider ID";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

serviceProviderIgnoreAvailableRequest($_POST['request_id'], $service_provider['provider_id']);

$_SESSION['success_messages'][]="Request ignored";
$_SESSION['form_values']=$_POST;
die(header('Location: ' . $_SERVER['HTTP_REFERER']));
?>
