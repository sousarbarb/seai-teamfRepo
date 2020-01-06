<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  $file_types = getDataFilterFileType();
  $smarty->assign('file_types', $file_types);
  if($_POST) {
    $mission_id = $_POST['mid'];
    $request_id = $_POST['rid'];
    $client_name = $_POST['c_name'];
    $_SESSION['mid'] = $_POST['mid'];
    $_SESSION['rid'] = $_POST['rid'];
    $_SESSION['c_name'] = $_POST['c_name'];
    $smarty->assign('mission_id', $mission_id);
    $smarty->assign('request_id', $request_id);
    $smarty->assign('client_name', $client_name);
  } else {
    $mission_id = $_SESSION['mid'];
    $request_id = $_SESSION['rid'];
    $client_name = $_SESSION['c_name'];
    $smarty->assign('mission_id', $mission_id);
    $smarty->assign('request_id', $request_id);
    $smarty->assign('client_name', $client_name);
  }
  $smarty->assign('menu', '4');
  $smarty->display('menu_requests_in_progress/provider_finish_request.tpl');
}
?>
