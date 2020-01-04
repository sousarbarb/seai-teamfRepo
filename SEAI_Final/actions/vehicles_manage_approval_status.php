<?php
include_once('../config/init.php');

if($_POST['vehicle_id_disapprove']) {
  $vehicle_id = $_POST['vehicle_id_disapprove'];
  $status = FALSE;
  $result = editVehicleApproval($vehicle_id, $status);
  $vehicle_name = getVehicleName($vehicle_id);
} elseif ($_POST['vehicle_id_approve']) {
  $vehicle_id = $_POST['vehicle_id_approve'];
  $status = TRUE;
  $result = editVehicleApproval($vehicle_id, $status);
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
  $_SESSION['success_messages'][]="Vehicle {$vehicle_name} is now Approved";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
} else {
  $_SESSION['success_messages'][]="Vehicle {$vehicle_name} is now Disapproved";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}
