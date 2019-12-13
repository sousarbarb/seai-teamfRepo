<?php
include_once('../config/init.php');

// Required field names
if ($acc_type=="client") {
  $required=array('name','email','number');
} else {
  $required=array('name','email','number','entity_name','entity_address',
                'entity_email','entity_number');
}

// Loop over field names, make sure each one exists and is not empty
$error = false;
foreach($required as $field) {
  if ((empty($_POST[$field])) || (ctype_space($_POST[$field]))) {
    $error = true;
  }
}

if ((strlen($_POST['name'])<3) || !(preg_match('/^[a-zA-Z ]+$/', $_POST['name']))) {
  $_SESSION['error_messages'][]="Name should contain more than 3 characters";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

if (!(preg_match('/^\+\d+$/', $_POST['number'])) || (strlen($_POST['number'])<8))  {
  $_SESSION['error_messages'][]="Phone number should be valid and contain a country calling code<br>following the pattern +[code][number]";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

if ($acc_type!="client") {
  if ((strlen($_POST['entity_name'])<3) || !(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST['entity_name']))) {
    $_SESSION['error_messages'][]="Entity name should contain more than 3 characters";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if ((strlen($_POST['entity_address'])<10) || !(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST['entity_name']))) {
    $_SESSION['error_messages'][]="Entity address should contain more than 10 characters";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if (!(preg_match('/^\+\d+$/', $_POST['entity_number'])) || (strlen($_POST['entity_number'])<8))  {
    $_SESSION['error_messages'][]="Entity phone number should be valid and contain a country calling code<br>following the pattern +[code][number]";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
}

if ($error) {
  $_SESSION['error_messages'][]="All fields are required";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
} else {
  $_SESSION['success_messages'][]="Changes applied successfully";
  $_SESSION['entity_name']=$_POST['entity_name'];
  die(header('Location: ' . $BASE_URL.'pages/index.php'));
}

?>
