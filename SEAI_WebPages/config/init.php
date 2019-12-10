<?php
session_start();

$BASE_DIR = dirname(__DIR__) . "/" ;
$BASE_URL = 'http://localhost/seai-teamfRepo/SEAI_WebPages/';

include_once($BASE_DIR . 'lib/smarty/Smarty.class.php');

$smarty = new Smarty;
$smarty->assign('BASE_URL', $BASE_URL);
$smarty->template_dir = $BASE_DIR . 'templates/';
$smarty->compile_dir = $BASE_DIR . 'templates_c/';



//**************VARIAVEIS TESTE******************
$_SESSION['login']="user";    //teste com login
//unset($_SESSION['login']);  //teste sem login
$acc_type="client";         //provider ou client
$smarty->assign('acc_type', $acc_type);
//**************VARIAVEIS TESTE******************
?>
