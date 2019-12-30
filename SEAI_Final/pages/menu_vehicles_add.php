<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  // Get all vehicle names to facilitate new creations
  $vehicles_names = getAllVehiclesNames();
  $smarty->assign('vehicles_names', $vehicles_names);

  // Get all sensor ids defined in the database
  $sensors_ids = getAllVehiclesSensorsIds();
  $smarty->assign('sensors_ids', $sensors_ids);

  // Get distinct specification types already defined in database
  $specification_types = getAllVehiclesSpecificationsTypes();
  $smarty->assign('specification_types', $specification_types);

  // Get distinct sensor types already defined in database
  $sensor_types = getAllVehiclesSensorsTypes();
  $smarty->assign('sensor_types', $sensor_types);

  // Get distinct communication types already defined in database
  $communication_types = getAllVehiclesCommunicationsTypes();
  $smarty->assign('communication_types', $communication_types);

  $smarty->assign('menu', '3');
  $smarty->display('menu_vehicles/menu_vehicles_add.tpl');
}
?>
