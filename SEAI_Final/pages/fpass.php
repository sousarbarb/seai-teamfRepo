<?php
include_once('../config/init.php');


if(!empty($smarty->getTemplateVars('login'))) {
  $smarty->assign('menu', '1');
  $smarty->display('menu_account/menu_my_account.tpl');
} else {
  $smarty->display('forgot_pass/forgotpass.tpl');
}


?>
