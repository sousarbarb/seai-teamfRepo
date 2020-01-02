<?php

  include_once('../config/init.php');

  if(!$_POST['res_id']){
    $_SESSION['error_messages'][]="Resolution not found";
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if(isset($_POST['vehicle_name']))
    $_SESSION['vehicle_name_temp'] = $_POST['vehicle_name'];

  $resolution_id = $_POST['res_id'];
  $active = FALSE;

  editResolutionActive($resolution_id, $active);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
    
?>