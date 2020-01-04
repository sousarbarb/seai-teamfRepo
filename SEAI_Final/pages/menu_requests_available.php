<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  $requests = getAllRequests( $smarty->getTemplateVars('user_id') );
  

  if ($requests==false){
  	$_SESSION['error_messages'][] = 'Request not found';
  }

  $smarty->assign('requests', $requests);

  $smarty->assign('menu', '4');
  $smarty->display('menu_requests_waiting/menu_requests_available.tpl');
}
?>