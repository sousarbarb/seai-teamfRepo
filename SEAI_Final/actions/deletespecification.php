<?php

  include_once('../config/init.php');

  if(!$_POST['spec_id']){
    $_SESSION['error_messages'][]="Specification not found";
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if(isset($_POST['vehicle_name']))
    $_SESSION['vehicle_name_temp'] = $_POST['vehicle_name'];

  $specification_id = $_POST['spec_id'];
  $active = FALSE;

  editSpecificationActive($specification_id, $active);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>