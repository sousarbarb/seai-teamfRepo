<?php
include_once('../config/init.php');

updateNotificationAcknowledge($_POST['notification_id']);

die(header('Location: ' . $_SERVER['HTTP_REFERER']));

?>
