<?php
include_once('../config/init.php');

	$smarty->assign('menu', '4');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
	if ($smarty->getTemplateVars('acc_type')=="client") {
	 $new = getHistoryRequestsNewDataServiceClient($smarty->getTemplateVars('user_id'));
	 $old = getHistoryRequestsOldDataServiceClient($smarty->getTemplateVars('user_id'));
	 $smarty->assign('requests_new', $new);
	 $smarty->assign('requests_old', $old);
	 //var_dump($old);
	$smarty->display('menu_requests_history/client_history.tpl');
	}
	else {
	$new = getHistoryRequestsServiceProvider($smarty->getTemplateVars('user_id'));
	$smarty->assign('requests_new', $new);
	$smarty->display('menu_requests_history/provider_history.tpl');
	}
}
?>
