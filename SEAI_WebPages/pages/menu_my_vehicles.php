<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  $smarty->assign('menu', '3');
  $smarty->display('menu_vehicles/menu_my_vehicles.tpl');
}
?>
