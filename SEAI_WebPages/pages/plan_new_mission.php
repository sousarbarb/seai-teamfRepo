<?php

include_once('../config/init.php');


$smarty->assign('menu', '4');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
	//$smarty->assign('restrictions', restrictionsSearch()); - will be used when database is ready
	$smarty->display('requests/Plan_new_mission.tpl');
}
?>
