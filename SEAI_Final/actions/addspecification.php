<?php

  include_once('../config/init.php');

  function test_input($data) {
      $data = trim($data);
      $data = stripslashes  ($data);
      $data = htmlspecialchars($data);
      $data = strip_tags($data);
      return $data;
  }

  // Testing specification type
  if(empty($_POST['type'])){
    $_SESSION['error_messages'][]="Type required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(ctype_space($_POST['type']) || strpos($_POST['type'], ' ') !== FALSE){
    $_SESSION['error_messages'][]="Type can not have white spaces";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(strlen(test_input($_POST["type"]))<2){
    $_SESSION['error_messages'][]="Type should contain more than 2 characters";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  $type = test_input($_POST["type"]);

  // Testing Value MIN
  if(!isset($_POST["valuemin"]) || strlen($_POST['valuemin'])==0){
    $_SESSION['error_messages'][]="Value min required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(!is_numeric($_POST["valuemin"])){
    $_SESSION['error_messages'][]="Value min must be a float number";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(floatval($_POST['valuemin'])<0){
    $_SESSION['error_messages'][]="Value min must be greater than zero";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  $valuemin = test_input($_POST["valuemin"]);

  // Testing Value MAX
  if(!isset($_POST["valuemax"]) || strlen($_POST['valuemax'])==0){
    $_SESSION['error_messages'][]="Value max required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(!is_numeric($_POST["valuemax"])){
    $_SESSION['error_messages'][]="Value max must be a float number";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(floatval($_POST['valuemax'])<0){
    $_SESSION['error_messages'][]="Value max must be greater than zero";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if(floatval($_POST['valuemax'])<floatval($_POST['valuemin'])){
    $_SESSION['error_messages'][]="Value max must be greater or equal to value min";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  $valuemax = test_input($_POST["valuemax"]);
  $comments = test_input($_POST['comments']);
  $vehicle_name = test_input($_POST['vehicle_name']);

  //guardar na DB todos os dados
  $result = createNewSpecificationAssociatedWithVehicle($type, $valuemin, $valuemax, $comments, $vehicle_name);

  switch ($result) {
      case -1:
          $_SESSION['error_messages'][] = 'Vehicle is inactive';
          break;
      case -2:
          $_SESSION['error_messages'][] = 'Error checking for vehicle search';
          break;
      case -3:
          $_SESSION['error_messages'][] = 'specification is active';
          break;
      case -4:
          $_SESSION['error_messages'][] = 'Updating was not completed successfully';
          break;
        case -5:
          $_SESSION['error_messages'][] = 'Insertion was not completed successfully';
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
