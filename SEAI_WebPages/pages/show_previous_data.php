<?php

include_once('../config/init.php');


$smarty->assign('menu', '4');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  $smarty->display('requests/Previous_data.tpl');
}
 ?>
