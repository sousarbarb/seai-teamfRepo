<?php

include_once('../config/init.php');

	$rid=$_POST['rid'];
	$mid=$_POST['mid'];
	$c_name=$_POST['c_name'];
	updateAgreementPaymentServiceProvider($rid,$mid);
	header("Location:  $BASE_URL" . 'pages/menu_requests_progress.php');

?>
