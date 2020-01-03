<?php
include_once('../config/init.php');
$target_dir = "../files/";
$target_file = $target_dir . basename($_FILES["real-file"]["name"]);

function test_input($data) {
  $data = trim($data);
  $data = stripslashes  ($data);
  $data = htmlspecialchars($data);
  return $data;
}

$required=array('starting_time','finishing_time','cost','vehicle','file');

// Loop over field names, make sure each one exists and is not empty
$error = false;
foreach($required as $field) {
  $_POST[$field] = test_input($_POST[$field]);
  if ((empty($_POST[$field])) || (ctype_space($_POST[$field]))) {
    $error = true;
  }
}

if (file_exists($target_file)) {
    $_SESSION['error_messages'][]="File already exists";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
   }

if (($_FILES['real-file']['size'] == 0) && ($_FILES['real-file']['error'] == 0)) {
  $_SESSION['error_messages'][]="Entity file required";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
} else {

  if (move_uploaded_file($_FILES["real-file"]["tmp_name"], $target_file)) {
    $file_path = "files/" . basename($_FILES["real-file"]["name"]);
  } else {
    $_SESSION['error_messages'][]="There was an error uploading your file";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
}

$sensor_name = getSensorNameForMission($_POST['vehicle'], $_POST['request_sensor_type'], $_POST['request_resolution_value']);

$return = createNewMission($_POST['request_id'], $_POST['starting_time'], $_POST['finishing_time'], $_POST['cost'], $smarty->getTemplateVar('login'), $_POST['vehicle'], $sensor_name, $_POST['request_resolution_value'], $file_path);

if ($return<0) {
  $_SESSION['error_messages'][]="Database function error";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

if ($error) {
  $_SESSION['error_messages'][]="All fields are required";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

if ($r<=0) {
  $_SESSION['error_messages'][]="Error creating new proposal";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

$_SESSION['success_messages'][]="New proposal successfully submited";
$_SESSION['form_values']=$_POST;
die(header('Location: ' . $_SERVER['HTTP_REFERER']));
?>