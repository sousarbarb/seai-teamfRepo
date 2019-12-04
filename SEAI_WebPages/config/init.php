<?php
session_start();

$BASE_DIR = dirname(__DIR__) . "/" ;
$BASE_URL = 'http://localhost/seai-teamfRepo/SEAI_WebPages/';

include_once($BASE_DIR . 'lib/smarty/Smarty.class.php');

$smarty = new Smarty;
$smarty->assign('BASE_URL', $BASE_URL);
$smarty->template_dir = $BASE_DIR . 'templates/';
$smarty->compile_dir = $BASE_DIR . 'templates_c/';

?>
