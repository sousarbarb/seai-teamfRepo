<?php
include_once('../config/init.php');

	$smarty->assign('menu', '4');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
	if ($smarty->getTemplateVars('acc_type')=="client") {
	 $smarty->display('menu_requests_history/client_progress.tpl');
	}
	else {
	$smarty->display('menu_requests_history/provider_progress.tpl');
	}
}
?>
