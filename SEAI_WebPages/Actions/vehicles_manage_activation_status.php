<?php
include_once('../config/init.php');

if($_POST['vehicle_id_deactivate']) {
  $vehicle_id = $_POST['vehicle_id_deactivate'];
  $status = FALSE;
  $result = editVehicleActive($vehicle_id, $status);
  $vehicle_name = getVehicleName($vehicle_id);
} elseif ($_POST['vehicle_id_activate']) {
  $vehicle_id = $_POST['vehicle_id_activate'];
  $status = TRUE;
  $result = editVehicleActive($vehicle_id, $status);
  $vehicle_name = getVehicleName($vehicle_id);
} else {
  $_SESSION['error_messages'][]="Invalid Command";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

if ($result<0) {
  $_SESSION['error_messages'][]="Invalid Vehicle or Error Applying Changes";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
} elseif ($status == TRUE) {
  $_SESSION['success_messages'][]="Vehicle {$vehicle_name} is now Active";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
} else {
  $_SESSION['success_messages'][]="Vehicle {$vehicle_name} is now Inactive";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}
