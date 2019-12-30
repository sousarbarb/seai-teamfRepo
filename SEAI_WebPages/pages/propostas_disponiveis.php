<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  $requests = getAllRequests( $smarty->getTemplateVars('user_id') );
  if (requests==-1){
  	$_SESSION['error_messages'][] = 'Request not found';
	die(header("Location:  $BASE_URL" . 'pages/propostas_disponiveis.php'));
  }

  $smarty->assign('menu', '4');
  $smarty->display('requests/propostas_disponiveis.tpl');
}
?>