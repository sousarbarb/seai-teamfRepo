<?php

  include_once('../config/init.php');

  if(!$_POST['spec_id']){
    $_SESSION['error_messages'][]="Specification not found";
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  $specification_id = $_POST['spec_id'];
  $active = FALSE;

  editSpecificationActive($specification_id, $active);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>