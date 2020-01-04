<?php
include_once('../config/init.php');

if($_POST['user_username_deactivate']) {
  $user_username = $_POST['user_username_deactivate'];
  $status = 'Inactive';
  $result = editUserStatus($user_username, $status);
  if (isset($_POST['user_type'])) deleteAllVehiclesServiceProvider($user_username);
  $entity_name = getServiceProviderEntityName($user_username);
  $status_approval = FALSE;
  $result = editServiceProviderApproval($entity_name, $status_approval);
} elseif ($_POST['user_username_activate']) {
  $user_username = $_POST['user_username_activate'];
  $status = 'Active';
  $result = editUserStatus($user_username, $status);
} else {
  $_SESSION['error_messages'][]="Invalid Command";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

if ($result<0) {
  $_SESSION['error_messages'][]="Invalid User or Error Applying Changes";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
} elseif ($status == TRUE) {
  $_SESSION['success_messages'][]="User {$user_username} is now Active";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
} else {
  $_SESSION['success_messages'][]="User {$user_username} is now Inactive";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}
