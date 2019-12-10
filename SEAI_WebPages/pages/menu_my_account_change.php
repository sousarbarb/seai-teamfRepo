<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  $smarty->assign('menu', '1');
  $smarty->display('menu_account/menu_my_account_change.tpl');
}
?>
