<?php
include_once('../config/init.php');

function test_input($data) {
  $data = trim($data);
  $data = stripslashes  ($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Required field names
$acc_type=$smarty->getTemplateVars('acc_type');
if ($acc_type=="client") {
  $required=array('name','address','email','number');
} elseif ($acc_type=="provider") {
  $required=array('name','email','number','entity_name','entity_address',
                'entity_email','entity_number');
} elseif ($acc_type=="admin") {
  $required=array('name','email','number');
} else {
  $_SESSION['error_messages'][]="Unexpected account type";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

// Loop over field names, make sure each one exists and is not empty
$error = false;
foreach($required as $field) {
  $_POST[$field] = test_input($_POST[$field]);
  if ((empty($_POST[$field])) || (ctype_space($_POST[$field]))) {
    $error = true;
  }
}

if ((strlen($_POST['name'])<3) || !(preg_match('/^[a-zA-Z ]+$/', $_POST['name']))) {
  $_SESSION['error_messages'][]="Name should contain more than 3 characters and should only contain letters";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

if ($acc_type=='client') {
  if (strlen($_POST['address'])<10) {
    $_SESSION['error_messages'][]="Address should contain more than 10 characters";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  $_SESSION['error_messages'][] = "Invalid email format";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

if (!(preg_match('/^\+\d+$/', $_POST['number'])) || (strlen($_POST['number'])<5))  {
  $_SESSION['error_messages'][]="Phone number should be valid and contain a country calling code<br>following the pattern +[code][number]";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

if ($acc_type=="provider") {
  if (strlen($_POST['entity_name'])<3) {
    $_SESSION['error_messages'][]="Entity name should contain more than 3 characters";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if (strlen($_POST['entity_address'])<10) {
    $_SESSION['error_messages'][]="Entity address should contain more than 10 characters";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if (!filter_var($_POST['entity_email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error_messages'][] = "Invalid entity email format";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if (!(preg_match('/^\+\d+$/', $_POST['entity_number'])) || (strlen($_POST['entity_number'])<5))  {
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
