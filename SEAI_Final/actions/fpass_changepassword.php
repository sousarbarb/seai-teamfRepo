<?php
include_once('../config/init.php');

function test_input($data) {
  $data = trim($data);
  $data = stripslashes  ($data);
  $data = htmlspecialchars($data);
  $data = strip_tags($data);
  return $data;
}

$required=array('new_password','confirm_password');



$error = false;
foreach($required as $field) {
  $_POST[$field] = test_input($_POST[$field]);
  if ((empty($_POST[$field])) || (ctype_space($_POST[$field]))) {
    $error = true;
  }
}

$password = $_POST['new_password'];
$password2 = $_POST['confirm_password'];
if (strlen($password)<7)  {
  $_SESSION['error_messages'][]="New password should contain more than 6 characters";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}


if ($password != $password2) {
  $_SESSION['error_messages'][]="New password and its confirmation are diferent";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

$r = changePassword($_SESSION['femail'],$password);
if($r<=0) {
  $_SESSION['error_messages'][]="Operation failed";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}
$_SESSION['success_messages'][]="Password changed successfully";
$_SESSION['form_values']=$_POST;
$status="Active";
$r2=editUserStatusWithMail($_SESSION['femail'],$status);
die(header('Location: ' . $BASE_URL.'pages/index.php'));

?>
