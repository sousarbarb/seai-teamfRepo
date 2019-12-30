<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  $notifications = getUnacknowledgedNotificationsSpecificUser($smarty->getTemplateVars('login'));
  $smarty->assign('notifications', $notifications);
  $smarty->assign('menu', '5');
  $smarty->display('menu_notifications/menu_notifications.tpl');
}
?>
