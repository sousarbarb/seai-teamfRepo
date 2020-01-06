<?php
  include_once('../config/init.php');

  function test_input($data) {
      $data = trim($data);
      $data = stripslashes  ($data);
      $data = htmlspecialchars($data);
      $data = strip_tags($data);
      return $data;
  }

  // Test vehicle privaty settings
  if(!$_POST['vehicle_public']){
    $_SESSION['error_messages'][]="Vehicle privaty setting must be define";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  // Test vehicle name
  if(empty($_POST['vehicle_name'])){
    $_SESSION['error_messages'][]="Vehicle name required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(ctype_space($_POST['vehicle_name']) || strpos($_POST['vehicle_name'], ' ') !== FALSE){
    $_SESSION['error_messages'][]="Vehicle name can not have white spaces";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if(strlen(test_input($_POST['vehicle_name'])) < 2){
    $_SESSION['error_messages'][]="Vehicle name should contain more than 2 characters";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  $vehicle_name = test_input($_POST['vehicle_name']);
  $public       = test_input($_POST['vehicle_public']);
  $localization = test_input($_POST['localization']);
  $comments     = test_input($_POST['comments']);
  $vehicle_id   = test_input($_POST['vehicle_id']);


    //guardar na DB todos os dados
    $result = editVehicle( $vehicle_id, $vehicle_name, $localization, $comments, ($public == 'y')? TRUE:FALSE );


  switch ($result) {
    case -1:
        $_SESSION['error_messages'][] = 'Updating was not completed successfully';
        break;
    case 0:
        $_SESSION['success_messages'][] = 'Updating was successful';
        break;
  }
  if($result == 0 ){
    if(isset($_POST['vehicle_name']))
      $_SESSION['vehicle_name_temp'] = $vehicle_name;

    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
?>
