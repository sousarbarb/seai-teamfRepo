<?php

  include_once('../config/init.php');

  function test_input($data) {
      $data = trim($data);
      $data = stripslashes  ($data);
      $data = htmlspecialchars($data);
      $data = strip_tags($data);
      return $data;
  }

  // Verify if vehicle name is defined in the form
  if(!$_POST['vehicle_name']){
    $_SESSION['error_messages'][]="Vehicle not found";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  // Testing communication type
  if(empty($_POST['type'])){
    $_SESSION['error_messages'][]="Communication type required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(ctype_space($_POST['type']) || strpos($_POST['type'], ' ') !== FALSE){
    $_SESSION['error_messages'][]="Communication type can not have white spaces";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(strlen(test_input($_POST['type'])) < 2){
    $_SESSION['error_messages'][]="Communication type should contain more than 2 characters";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  $type = test_input($_POST['type']);
  $vehicle_name = test_input($_POST['vehicle_name']);
    
  //guardar na DB todos os dados
  $result = createNewCommunicationAssociatedWithVehicle($type, $vehicle_name);
                    

  switch ($result) {
      case -1:
          $_SESSION['error_messages'][] = 'Vehicle is inactive';
          break;
      case -2:
          $_SESSION['error_messages'][] = 'Error checking for vehicle search';
          break;
      case 1:
          $_SESSION['success_messages'][] = 'Updating an existing specification but inactive was successfully';
          break;
      case 2:
          $_SESSION['success_messages'][] = 'Inserting a new specification was completed successfully';
          break; 
  }
  if( $result > 0 ){
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
?>