<?php
include_once('../config/init.php');
$target_dir = "../files/";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes  ($data);
  $data = htmlspecialchars($data);
  return $data;
}

$required=array('cost','link','file_type');

// Loop over field names, make sure each one exists and is not empty
$error = false;
foreach($required as $field) {
  $_POST[$field] = test_input($_POST[$field]);
  if ((empty($_POST[$field])) || (ctype_space($_POST[$field]))) {
    $error = true;
  }
}

$_SESSION['mid'] = $_POST['mission_id'];
$_SESSION['rid'] = $_POST['request_id'];
$_SESSION['c_name'] = $_POST['client_name'];

if ($error) {
  $_SESSION['error_messages'][]="All fields are required";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

$return = //funcao();

if ($return<0) {
  $_SESSION['error_messages'][]="Error inserting in database";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

$_SESSION['success_messages'][]="Data successfully sent";
$_SESSION['form_values']=$_POST;
die(header('Location: ' . $BASE_URL . 'pages/menu_requests_progress.php'));
?>
