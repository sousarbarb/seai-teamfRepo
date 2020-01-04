

<?php

include_once('../config/init.php');

$smarty->assign('menu', '4');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
$result=verifyLandOrSeaRestriction($_SESSION["area"]);

if($result){
  // Get all distinct types of sensors
 if(isset($_POST['sensors_array'])){
    $smarty->assign( 'sensors_selected' ,  $_POST['sensors_array'] );
    $sensors_selected = $_POST['sensors_array'];
  }
  $sensors = getAllActiveDistinctSensorTypes();
  $smarty->assign('sensors', $sensors);

  // Get all distinct resolution values
  if(isset($_POST['resolutions_array'])){
    $smarty->assign( 'resolutions_selected' ,  $_POST['resolutions_array'] );
    $resolutions_selected = $_POST['resolutions_array'];
  }
  $resolutions = getAllActiveDistinctResolutionValues();
  $smarty->assign('resolutions', $resolutions);
  
   if(isset($_POST['file_type_array'])){
    $smarty->assign( 'file_type_selected' ,  $_POST['file_type_array'] );
    $file_type_selected = $_POST['file_type_array'];
  }
  $ftype = getDataFilterFileType();
  $smarty->assign('file_type', $ftype);
  
  $result=searchDataWithFilters($_SESSION["area"],
  isset($sensors_selected)?           $sensors_selected           : NULL,
  isset($resolutions_selected)?       $resolutions_selected       : NULL,
  isset($file_type_selected)?    $file_type_selected    : NULL
);
  $smarty->assign('requests', $result);
  $smarty->display('requests/Previous_data.tpl');
}
else{
	$_SESSION['error_messages'][] = 'The selected area must be on the ocean';
	die(header("Location: $BASE_URL". '/pages/map.php'));
}
}

 ?>