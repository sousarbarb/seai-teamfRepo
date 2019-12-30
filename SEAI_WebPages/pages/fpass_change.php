<?php

include_once('../config/init.php');

$token = $_REQUEST['token'];
$result = verifyEmailExistance($token);
if($result==-1){
	$_SESSION['error_messages'][] = 'email does not exist';
	die(header("Location:  $BASE_URL" . 'pages/index.php'));
}
else {
	$_SESSION['femail']=$token;
	$smarty->display('forgot_pass/fpass_change.tpl');
}

 ?>
