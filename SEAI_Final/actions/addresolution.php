<?php

  include_once('../config/init.php');

  function test_input($data) {
      $data = trim($data);
      $data = stripslashes  ($data);
      $data = htmlspecialchars($data);
      $data = strip_tags($data);
      return $data;
  }

  // Verify if sensor id is defined in the form
  if(!$_POST['sensor_id']){
    $_SESSION['error_messages'][]="Sensor not found";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  // Testing resolution value
  if(!isset($_POST['value']) || strlen($_POST['value'])==0){
    $_SESSION['error_messages'][]="Resolution value required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(!is_numeric($_POST['value'])){
    $_SESSION['error_messages'][]="Resolution value must be a float number";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(floatval($_POST['value'])<=0){
    $_SESSION['error_messages'][]="Resolution value must be greater than zero";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  $value = test_input($_POST['value']);

  // Testing nominal velocity with vehicle running at resolution value specified
  if(!isset($_POST['vel_sampling']) || strlen($_POST['vel_sampling'])==0){
    $_SESSION['error_messages'][]="Velocity required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(!is_numeric($_POST['vel_sampling'])){
    $_SESSION['error_messages'][]="Velocity must be a float number";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(floatval($_POST['vel_sampling'])<=0){
    $_SESSION['error_messages'][]="Velocity must be greater than zero";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  $vel_sampling = test_input($_POST['vel_sampling']);

  // Testing battery impact when sensor is running at VALUE resolution
  if(!isset($_POST['consumption']) || strlen($_POST['consumption'])==0){
    $_SESSION['error_messages'][]="Consumption required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(!is_numeric($_POST['consumption'])){
    $_SESSION['error_messages'][]="Consumption must be a float number";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  $consumption = test_input($_POST['consumption']);

  // Testing sensor swath
  if(!isset($_POST['swath']) || strlen($_POST['swath'])==0){
    $_SESSION['error_messages'][]="Sensor swath required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(!is_numeric($_POST['swath'])){
    $_SESSION['error_messages'][]="Sensor swath must be a float number";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(floatval($_POST['swath'])<=0){
    $_SESSION['error_messages'][]="Swath must be greater than zero";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  $swath = test_input($_POST['swath']);

  // Testing cost per hour (monetary) of vehicle running at that resolution
  if(!isset($_POST['cost']) || strlen($_POST['cost'])==0){
    $_SESSION['error_messages'][]="Cost required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(!is_numeric($_POST['cost'])){
    $_SESSION['error_messages'][]="Cost must be a float number";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  $cost = test_input($_POST['cost']);
  $comments = test_input($_POST['comments']);
  $sensor_id = test_input($_POST['sensor_id']);

  //guardar na DB todos os dados
  $result = createNewResolutionAssociatedWithSensor($value, $vel_sampling, $consumption, $swath, $cost, $comments, $sensor_id);

  switch ($result) {
      case -1:
          $_SESSION['error_messages'][] = 'Resolution is active';
          break;
      case -2:
          $_SESSION['error_messages'][] = 'Updating was not completed successfully';
          break;
        case -3:
          $_SESSION['error_messages'][] = 'Insertion was not completed successfully';
          break;
      case 1:
          $_SESSION['success_messages'][] = 'Updating an existing resolution but inactive was successfully';
          break;
      case 2:
          $_SESSION['success_messages'][] = 'Inserting a new resolution was completed successfully';
          break;
  }
  if( $result > 0 ){
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
?>
