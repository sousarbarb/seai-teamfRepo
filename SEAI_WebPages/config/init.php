<?php
session_start();

$BASE_DIR = dirname(__DIR__) . "/" ;
$BASE_URL = 'http://localhost/seai-teamfRepo/SEAI_WebPages/';

//********************SMARTY*********************
include_once($BASE_DIR . 'lib/smarty/Smarty.class.php');

$smarty = new Smarty;
$smarty->assign('BASE_URL', $BASE_URL);
$smarty->template_dir = $BASE_DIR . 'templates/';
$smarty->compile_dir = $BASE_DIR . 'templates_c/';


//*************DATABSE CONNECTION****************
$conn = new PDO('pgsql:host=128.199.59.162;dbname=seai', 'sousa', 'sousa');
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);  // Enables by default the associative fetch mode from queries
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       // Enables the exception handling mechanism
/*
$stmt=$conn->prepare("set schema 'schema_example';");
$stmt->execute();
*/

//**************DATABASE FUNCTIONS***************
include_once($BASE_DIR . 'database/users.php');



//**************VARIAVEIS TESTE******************
//$_SESSION['login']="user";    //teste com login
//unset($_SESSION['login']);  //teste sem login
//$_SESSION['acc_type']="provider";         //provider ou client
//$_SESSION['entity_name']="lsts";



//**************SESSION VARIABLES SMARTY******************
if (isset($_SESSION['login'])) {
  $smarty->assign('login', $_SESSION['login']);
}

if (isset($_SESSION['acc_type'])) {
  $smarty->assign('acc_type', $_SESSION['acc_type']);
}

/*if (isset($_SESSION['entity_name'])) {
  $smarty->assign('entity_name', $_SESSION['entity_name']);
}*/

if (isset($_SESSION['user_id'])) {
  $smarty->assign('user_id', $_SESSION['user_id']);
}

if (isset($_SESSION['form_values'])) {
  $smarty->assign('form_values', $_SESSION['form_values']);
  unset($_SESSION['form_values']);
}

if (isset($_SESSION['error_messages'])) {
  $smarty->assign('error_messages', $_SESSION['error_messages']);
  unset($_SESSION['error_messages']);
}

if (isset($_SESSION['success_messages'])) {
  $smarty->assign('success_messages', $_SESSION['success_messages']);
  unset($_SESSION['success_messages']);
}

?>
