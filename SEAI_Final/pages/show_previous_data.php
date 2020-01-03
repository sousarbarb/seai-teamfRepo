<?php

include_once('../config/init.php');

$smarty->assign('menu', '4');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
$result=verifyLandOrSeaRestriction($_SESSION["area"]);

if($result){
  $result=searchDataWithFilters($_SESSION["area"],null,null,null);
  $smarty->assign('requests', $result);
  $smarty->display('requests/Previous_data.tpl');
}
else{
	$_SESSION['error_messages'][] = 'The selected area must be on the ocean';
	die(header("Location: $BASE_URL". '/pages/map.php'));
}
}

 ?>

