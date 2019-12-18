<?php

include_once('../config/init.php');

$token = $_REQUEST['token'];


//$notverified = get_account_by_id_thats_not verify


if ($notverified){
	
	header("Location:  $BASE_URL" . 'pages/index.php');
}	
 else
    {
    header("Location:  $BASE_URL" . 'pages/index.php');
    }
	
 ?>
