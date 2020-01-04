<?php

include_once('../config/init.php');


$smarty->assign('menu', '4');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
	$result=getMinMaxDepthAreaFromStructure($_SESSION["area"]);
	$smarty->assign('depth', $result);
	$smarty->assign('sensors', sensorsSearch(getAllActiveDistinctSensorTypes()));
	$smarty->assign('resolutions', resolutionsSearch(getAllActiveDistinctResolutionValues()));
	$smarty->display('requests/Plan_new_mission.tpl');
}
?>
