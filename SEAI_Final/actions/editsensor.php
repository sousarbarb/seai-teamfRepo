<?php

  include_once('../config/init.php');

  function test_input($data) {
      $data = trim($data);
      $data = stripslashes  ($data);
      $data = htmlspecialchars($data);
      $data = strip_tags($data);
      return $data;
  }

  // Test if sensor_id is defined
  if(!$_POST['sensor_id']){
    $_SESSION['error_messages'][]="Sensor not found";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  // Testing sensor name
  if(empty($_POST['sensor_name'])){
    $_SESSION['error_messages'][]="Sensor name required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(ctype_space($_POST['sensor_name']) || strpos($_POST['sensor_name'], ' ') !== FALSE){
    $_SESSION['error_messages'][]="Sensor name can not have white spaces";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(strlen(test_input($_POST['sensor_name'])) < 2){
    $_SESSION['error_messages'][]="Sensor name should contain more than 2 characters";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  $sensor_name = test_input($_POST['sensor_name']);
  $comments = test_input($_POST['comments']);
  $sensor_id = test_input($_POST['sensor_id']);

  // Guardar na DB todos os dados
  $result = editSensor($sensor_id, $sensor_name, $comments);

  switch ($result) {
      case -1:
          $_SESSION['error_messages'][] = 'Updating was not completed successfully';
          break;
      case 0:
          $_SESSION['success_messages'][] = 'Updating was successful';
          break;
  }
  if($result == 0 ){
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
?>
