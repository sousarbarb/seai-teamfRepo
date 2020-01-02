<?php

  include_once('../config/init.php');

  // Verify if communication id is defined in the form
  if(!$_POST['communication_id']){
    $_SESSION['error_messages'][]="Communication not found";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if(isset($_POST['vehicle_name']))
    $_SESSION['vehicle_name_temp'] = $_POST['vehicle_name'];

  $communication_id = $_POST['communication_id'];

  deleteVehicleCommunication($communication_id);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  
?>