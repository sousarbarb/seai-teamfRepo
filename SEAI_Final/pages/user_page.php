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
    $acc_info=getSpecificServiceProviderInfo($_POST['userinfo_username']);
  }
  else if($type=='client') {
    $acc_info=getSpecificServiceClientInfo($_POST['userinfo_username']);
  }
  else if($type=='admin') {
    $acc_info=getSpecificAdministratorInfo($_POST['userinfo_username']);
  }
  else {
    $acc_info='error';
  }

  // Display template
  $smarty->assign('PREVIOUSPAGE', $_SERVER['HTTP_REFERER']);
  $smarty->assign('type', $type);
  $smarty->assign('acc_info', $acc_info);
  $smarty->display('user_page.tpl');
?>