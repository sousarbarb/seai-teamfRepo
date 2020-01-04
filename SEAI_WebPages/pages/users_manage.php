<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  $not_inactive_users = getAllNotInactiveUsers();
  $smarty->assign('not_inactive_users', $not_inactive_users);

  $inactive_users = getAllInactiveUsers();
  $smarty->assign('inactive_users', $inactive_users);

  $smarty->assign('menu', '3');
  $smarty->display('menu_admin/users_manage.tpl');
}
?>
