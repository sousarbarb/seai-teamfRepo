<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  $smarty->assign('menu', '2');
  $smarty->display('menu_data/menu_my_data.tpl');
}
?>
