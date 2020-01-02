<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  if($_POST) {
    $vehicle_name = $_POST['vehicle_name'];
    $smarty->assign('vehicle_name', $vehicle_name);

    $resolution_id = $_POST['res_id'];
    $smarty->assign('resolution_id', $resolution_id);

    $vel_sampling = $_POST['res_velocity'];
    $smarty->assign('vel_sampling', $vel_sampling);

    $consumption = $_POST['res_consumption'];
    $smarty->assign('consumption', $consumption);

    $swath = $_POST['res_swath'];
    $smarty->assign('swath', $swath);

    $cost = $_POST['res_cost'];
    $smarty->assign('cost', $cost);

    $comments = $_POST['res_comments'];
    $smarty->assign('comments', $comments);
  }
  $smarty->assign('menu', '3');
  $smarty->display('menu_vehicles/editresolution.tpl');
}
?>
