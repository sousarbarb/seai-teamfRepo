<?php

include_once('../config/init.php');

$smarty->display('header.tpl');
if(1) {
//if(isset($_SESSION['login']) && !empty($_SESSION['login'])) {
  $smarty->display('navbar_logged_in.tpl');
  $smarty->display('logout.tpl');
  $smarty->display('menu_my_account.tpl');
} else {
  $smarty->display('inicial.tpl');
  $smarty->display('login_form.tpl');
}
 ?>
