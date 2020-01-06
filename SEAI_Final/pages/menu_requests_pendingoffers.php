<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  $pending_missions = getPendingMissionsProposals($smarty->getTemplateVars('user_id'));
  $smarty->assign('pending_missions', $pending_missions);

  $smarty->assign('menu', '4');
  $smarty->display('menu_requests_waiting/menu_requests_pendingoffers.tpl');
}
?>
