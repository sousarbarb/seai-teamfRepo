<?php
include_once('../config/init.php');

if($_POST['user_username_disapprove']) {
  $user_username = $_POST['user_username_disapprove'];
  $status = FALSE;
  $entity_name = getServiceProviderEntityName($user_username);
  $result = editServiceProviderApproval($entity_name, $status);
} elseif ($_POST['user_username_approve']) {
  $user_username = $_POST['user_username_approve'];
  $status = TRUE;
  $entity_name = getServiceProviderEntityName($user_username);
  $result = editServiceProviderApproval($entity_name, $status);
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
  $_SESSION['success_messages'][]="User {$user_username} is now Approved";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
} else {
  $_SESSION['success_messages'][]="User {$user_username} is now Disapproved";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}
