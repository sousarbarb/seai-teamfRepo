<?php

  include_once('../config/init.php');

  if(isset($_SESSION['vehicle_name_temp']))
    unset($_SESSION['vehicle_name_temp']);

  $vehicle_id = $_POST['vehicle_id'];
  $active = FALSE;

  editVehicleActive($vehicle_id, $active);
  header('Location: ' . $BASE_URL . 'pages/menu_my_vehicles.php');
    
?>