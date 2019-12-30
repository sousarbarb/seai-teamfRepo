<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  $smarty->assign('menu', '1');
  $acc_type=$smarty->getTemplateVars('acc_type');
  $login=$smarty->getTemplateVars('login');
  if($acc_type=='provider') {
    $acc_info=getSpecificServiceProviderInfo($login);
  } elseif($acc_type=='client') {
    $acc_info=getSpecificServiceClientInfo($login);
  } elseif($acc_type=='admin') {
    $acc_info=getSpecificAdministratorInfo($login);
  } else {
    $acc_info='error';
  }
  $smarty->assign('acc_info', $acc_info); //para aceder nesta página
  //$_SESSION['acc_info']=$smarty->getTemplateVars('acc_info');
  $smarty->display('menu_account/menu_my_account_change.tpl');
}
?>
