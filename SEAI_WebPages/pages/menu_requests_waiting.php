<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  $missions = getAllMissionsProposal( $smarty->getTemplateVars('user_id'));
  if ($missions==false){
  	$_SESSION['error_messages'][] = 'Mission not found';
  }
  $smarty->assign('menu', '4');
  $smarty->display('menu_requests_waiting/menu_requests_waiting.tpl');
}
?>