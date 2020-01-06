<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  if($_POST) {
    $vehicles = getAllProviderVehiclesNamesMission( $smarty->getTemplateVars('user_id'), $_POST['request_sensor_type'], $_POST['request_res_value'] );
    $request_id = $_POST['request_id'];
    $request_sensor_type = $_POST['request_sensor_type'];
    $request_res_value = $_POST['request_res_value'];
    $_SESSION['request_id'] = $_POST['request_id'];
    $_SESSION['request_sensor_type'] = $_POST['request_sensor_type'];
    $_SESSION['request_res_value'] = $_POST['request_res_value'];
    $smarty->assign('vehicles', $vehicles);
    $smarty->assign('request_id', $request_id);
    $smarty->assign('request_sensor_type', $request_sensor_type);
    $smarty->assign('request_res_value', $request_res_value);
  /*} elseif($smarty->getTemplateVars('form_values')) {
    $form_values = $smarty->getTemplateVars('form_values');
    $vehicles = getAllProviderVehiclesNamesMission( $smarty->getTemplateVars('user_id'), $form_values['request_sensor_type'], $form_values['request_res_value'] );
    $smarty->assign('vehicles', $vehicles);*/
  } else {
    $request_id = $_SESSION['request_id'];
    $request_sensor_type = $_SESSION['request_sensor_type'];
    $request_res_value = $_SESSION['request_res_value'];
    $smarty->assign('request_id', $request_id);
    $smarty->assign('request_sensor_type', $request_sensor_type);
    $smarty->assign('request_res_value', $request_res_value);
    $vehicles = getAllProviderVehiclesNamesMission( $smarty->getTemplateVars('user_id'), $request_sensor_type, $request_res_value );
    $smarty->assign('vehicles', $vehicles);
  }
  $smarty->assign('menu', '4');
  $smarty->display('requests/form_proposalnewmission.tpl');
}
?>
