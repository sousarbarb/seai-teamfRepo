<?php

  include_once('../config/init.php');

  if(!$_POST['res_id']){
    $_SESSION['error_messages'][]="Resolution not found";
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  $resolution_id = $_POST['res_id'];
  $active = FALSE;

  editResolutionActive($resolution_id, $active);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
    
?>