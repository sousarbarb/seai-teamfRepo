<?php
  include_once('../config/init.php');

  // Check if the username is defined
  if(!isset($_POST['userinfo_username'])){
    $_SESSION['error_messages'][]="User not found";
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  // Process user type
  $type = getUserType( $_POST['userinfo_username'] );
  if($type=='provider') {
    $acc_info_see=getSpecificServiceProviderInfo($_POST['userinfo_username']);
  }
  else if($type=='client') {
    $acc_info_see=getSpecificServiceClientInfo($_POST['userinfo_username']);
  }
  else if($type=='admin') {
    $acc_info_see=getSpecificAdministratorInfo($_POST['userinfo_username']);
  }
  else {
    $acc_info_see='error';
  }

  // Display template
  $smarty->assign('PREVIOUSPAGE', $_SERVER['HTTP_REFERER']);
  $smarty->assign('type', $type);
  $smarty->assign('menu', '');
  $smarty->assign('acc_info_see', $acc_info_see);
  $smarty->display('users/user_page.tpl');
?>