<?php

  include_once('../config/init.php');

  if(!$_POST['sensor_id']){
    $_SESSION['error_messages'][]="Sensor not found";
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  $sensor_id = $_POST['sensor_id'];
  $active = FALSE;

  editSensorActive($sensor_id, $active);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>