<?php

include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
    die(header('Location: index.php'));
  } else {
    if($_POST) {
      $vehicle_name = $_POST['vehicle_name'];
      $smarty->assign('vehicle_name', $vehicle_name);

      $sensor_id = $_POST['sensor_id'];
      $smarty->assign('sensor_id', $sensor_id);
    }
    $smarty->assign('menu', '3');
    $smarty->display('menu_vehicles/addresolution.tpl');
    }

?>
