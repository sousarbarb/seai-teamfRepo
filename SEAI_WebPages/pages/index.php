<?php

include_once('../config/init.php');

//if(1) {
if(isset($_SESSION['login']) && !empty($_SESSION['login'])) {
  $smarty->assign('menu', '1');
  $smarty->display('menu_account/menu_my_account.tpl');
} else {
  $smarty->display('inicial/inicial.tpl');
}
 ?>
 