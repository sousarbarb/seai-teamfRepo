<?php

include_once('../config/init.php');

$token = $_REQUEST['token'];
$result = emailVerificationValidation($token);
if($result==-1){
	$_SESSION['error_messages'][] = 'Verification failed';
	die(header("Location:  $BASE_URL" . 'pages/register.php'));
}
else {
	$username=$result['username'];
	$status="Active";
try {
    if( editUserStatus($username, $status) > 0 ) {
      $_SESSION['success_messages'][] = "Username: $username - New Status: $status";
	  die(header("Location:  $BASE_URL" . 'pages/index.php'));
    } else {
      $_SESSION['error_messages'][] = 'Username not registed in the platform';
	  die(header("Location:  $BASE_URL" . 'pages/register.php'));
    }
  }  catch (PDOException $e) {
		$_SESSION['error_messages'][] = 'Updating operation failed';
		die(header("Location:  $BASE_URL" . 'pages/register.php'));

  }
}

 ?>
