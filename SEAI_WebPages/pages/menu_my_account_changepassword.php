<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  $smarty->assign('menu', '1');
  $_SESSION['acc_info']=$smarty->getTemplateVars('acc_info');
  $smarty->display('menu_account/menu_my_account_changepassword.tpl');
}
?>
