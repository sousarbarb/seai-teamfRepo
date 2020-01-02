<?php

  include_once('../config/init.php');

  if(!$_POST['sensor_id']){
    $_SESSION['error_messages'][]="Sensor not found";
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if(isset($_POST['vehicle_name']))
    $_SESSION['vehicle_name_temp'] = $_POST['vehicle_name'];

  $sensor_id = $_POST['sensor_id'];
  $active = FALSE;

  editSensorActive($sensor_id, $active);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>