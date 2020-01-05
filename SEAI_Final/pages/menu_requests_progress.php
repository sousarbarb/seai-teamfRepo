<?php
include_once('../config/init.php');

	$smarty->assign('menu', '4');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
	if ($smarty->getTemplateVars('acc_type')=="client") {
	 $new = getInProgressRequestsNewDataServiceClient($smarty->getTemplateVars('user_id'));
	 $old = getInProgressRequestsOldDataServiceClient($smarty->getTemplateVars('user_id'));
	 $smarty->assign('requests_new', $new);
	 $smarty->assign('requests_old', $old);
	 //var_dump($old);
	$smarty->display('menu_requests_in_progress/client_progress.tpl');
	}
	else {
	$new = getInProgressRequestsNewDataServiceProvider($smarty->getTemplateVars('user_id'));
	$old = getInProgressRequestsOldDataServiceProvider($smarty->getTemplateVars('user_id'));
	$smarty->assign('requests_new', $new);
	$smarty->assign('requests_old', $old);
	$smarty->display('menu_requests_in_progress/provider_progress.tpl');
	}
}
?>
