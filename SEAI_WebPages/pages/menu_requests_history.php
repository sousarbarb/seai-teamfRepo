<?php
include_once('../config/init.php');

	$smarty->assign('menu', '4');
	$acc_type="provider";

	if ($acc_type=="client") {
	 $smarty->display('menu_requests_history/client_history.tpl');
	}
	else {
	$smarty->display('menu_requests_history/provider_history.tpl');
	}

?>
