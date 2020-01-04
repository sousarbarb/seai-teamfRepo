<?php

  include_once('../config/init.php');

  // Test if user is logged-in
  if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
    $_SESSION['error_messages'][]="You must be logged in to access this page";
    die(header("Location: $BASE_URL"));
  }

  // Get vehicle name (by post or by name)
  if ( isset($_SESSION["r_id"]) ) {
      $smarty->assign('rid', $_SESSION["r_id"]);
	  $result=getRequestInfo($_SESSION["r_id"]);
	  $smarty->assign('notpublic', $result['request_restricted']);
	  $smarty->assign('info', $result);
	  $smarty->assign('acc_type', $_SESSION['acc_type']);
	  //PRINT_R($result['mission_status']);
  }
  else {
    $_SESSION['error_messages'][]="Survey Data not found";
    die(header("Location: $BASE_URL"));
  }
  //$vehicle_name = $_POST['vehicle_name'];
  $smarty->assign('PREVIOUSPAGE', $_SERVER['HTTP_REFERER']);
  $smarty->assign('menu', '4');
  $smarty->display('requests/req_pag.tpl');

?>
