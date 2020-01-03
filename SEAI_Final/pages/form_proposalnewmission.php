<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  if(!($_POST)) {
  	$_SESSION['error_messages'][]="Invalid Request Data";
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  $vehicles = getAllProviderVehiclesNamesMission( $smarty->getTemplateVars('user_id'), $_POST['request_sensor_type'], $_POST['request_res_value'] );
  $smarty->assign('vehicles', $vehicles);

  $request_id = $_POST['request_id'];
  $smarty->assign('request_id', $request_id);

  $request_sensor_type = $_POST['request_sensor_type'];
  $smarty->assign('request_sensor_type', $request_sensor_type);

  $request_res_value = $_POST['request_res_value'];
  $smarty->assign('request_res_value', $request_res_value);

  $smarty->assign('menu', '4');
  $smarty->display('requests/form_proposalnewmission.tpl');
}
?>
