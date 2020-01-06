<?php
include_once('../config/init.php');
$target_dir = "../files/";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes  ($data);
  $data = htmlspecialchars($data);
  return $data;
}

$required=array('starting_time','finishing_time','cost','vehicle');

// Loop over field names, make sure each one exists and is not empty
$error = false;
foreach($required as $field) {
  $_POST[$field] = test_input($_POST[$field]);
  if ((empty($_POST[$field])) || (ctype_space($_POST[$field]))) {
    $error = true;
  }
}

$_SESSION['request_id'] = $_POST['request_id'];
$_SESSION['request_sensor_type'] = $_POST['request_sensor_type'];
$_SESSION['request_res_value'] = $_POST['request_res_value'];

if (!is_numeric($_POST['cost'])) {
  $_SESSION['error_messages'][]="Cost needs to be a number";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

if ($error) {
  $_SESSION['error_messages'][]="All fields are required";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

if ($_FILES['real-file']['size'] == 0) {
  $_SESSION['error_messages'][]="Entity file required";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

// Check the file extension
$extension  = strtolower( pathinfo( basename($_FILES['real-file']['name']) , PATHINFO_EXTENSION ) );
// Checks the extension
if ($extension != 'pdf') {
  $_SESSION['error_messages'][] = 'Only PDF files are allowed';
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
} else {
  $send_image = '1';
}

$sensor_name = getSensorNameForMission($_POST['vehicle'], $_POST['request_sensor_type'], $_POST['request_res_value']);

if (empty($sensor_name)) {
  $_SESSION['error_messages'][]="Could not get sensor name for this request";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

$return = createNewMission($_POST['request_id'],
                          $_POST['starting_time'],
                          $_POST['finishing_time'],
                          $_POST['cost'],
                          $smarty->getTemplateVars('login'),
                          $_POST['vehicle'],
                          $sensor_name['sensor_name'],
                          $_POST['request_res_value'],
                          $file_path);

if ($return<0) {
  if ($return == -1) $_SESSION['error_messages'][]="The user is not registed in the platform or it isn't a service provider";
  else if ($return == -2) $_SESSION['error_messages'][]="The provider isn't an Active user";
  else if ($return == -3) $_SESSION['error_messages'][]="The service provider has yet to be approved by administration";
  else if ($return == -4) $_SESSION['error_messages'][]="Date format isn't valid. The correct one is 'DD/MM/AAAA'";
  else if ($return == -5) $_SESSION['error_messages'][]="Estimate start and finish must be a date after today";
  else if ($return == -6) $_SESSION['error_messages'][]="Estimated finish date must be after estimated start date";
  else if ($return == -7) $_SESSION['error_messages'][]="Request id does not exist";
  else if ($return == -8) $_SESSION['error_messages'][]="The vehicle specified was not found in the service provider list of vehicles";
  else if ($return == -9) $_SESSION['error_messages'][]="The vehicle isn't active";
  else if ($return == -10) $_SESSION['error_messages'][]="The vehicle doesn't have administration approval";
  else if ($return == -11) $_SESSION['error_messages'][]="The sensor_name doesn't belong to the vehicle or the type of sensor required to execute the mission isn't satisfied";
  else if ($return == -12) $_SESSION['error_messages'][]="The sensor specified isn't active";
  else if ($return == -13) $_SESSION['error_messages'][]="The resolution required for the request doesn't match with the selected one by provider";
  else if ($return == -14) $_SESSION['error_messages'][]="The resolution doesn't match with sensor specified";
  else if ($return == -15) $_SESSION['error_messages'][]="The resolution selected isn't active";
  else if ($return == -16) $_SESSION['error_messages'][]="Inserting the new mission was not possible";
  else if ($return == -17) $_SESSION['error_messages'][]="Relating the mission with the request was not possible";
  else if ($return == -20) $_SESSION['error_messages'][]="Vehicle doesn't satisfies the depth requirements to execute the mission";
  else if ($return == -21) $_SESSION['error_messages'][]="Service provider can't guarantee that mission will be concluded on time";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

if ($send_image == '1') {
  $target_file = $target_dir . 'mission_'. $return . '_details_'.basename($_FILES["real-file"]["name"]);
  if (file_exists($target_file)) {
      $_SESSION['error_messages'][]="File already exists";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if (move_uploaded_file($_FILES["real-file"]["tmp_name"], $target_file)) {
    $file_path = "files/" . 'mission_'. $return . '_details_'.basename($_FILES["real-file"]["name"]);
    $stm = $conn->prepare("
      UPDATE mission
      SET path_pdf = ?
      WHERE id = ?
    ");
    $stm->execute(array($file_path, $return));
  } else {
    $_SESSION['error_messages'][]="There was an error uploading your file";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
}

$_SESSION['success_messages'][]="New proposal successfully submited";
$_SESSION['form_values']=$_POST;
die(header('Location: ' . $BASE_URL . 'pages/menu_requests_available.php'));
?>
