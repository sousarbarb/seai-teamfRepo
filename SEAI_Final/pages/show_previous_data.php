<?php

include_once('../config/init.php');
$result=searchDataWithFilters($_SESSION["area"],null,null,null);
//print_r($result);

$smarty->assign('menu', '4');
$smarty->assign('requests', $result);

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  $smarty->display('requests/Previous_data.tpl');
}

 ?>
