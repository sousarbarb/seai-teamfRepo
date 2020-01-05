<?php

include_once('../config/init.php');

	$rid=$_POST['rid'];
	$mid=$_POST['mid'];
	$c_name=$_POST['c_name'];
  updateAgreementPaymentServiceClient($rid,$mid);
  notifyServiceProviderOfServiceClientAgreementStatusOldData($rid,$mid,$agreement_status);
	header("Location:  $BASE_URL" . 'pages/menu_requests_progress.php');

?>
