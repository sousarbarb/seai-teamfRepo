<?php

  include_once('../config/init.php');

  // Test if user is logged-in
  if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
    $_SESSION['error_messages'][]="You must be logged in to access this page";
    die(header("Location: $BASE_URL"));
  }

  // Get vehicle name (by post or by name)
  if ( isset($_POST['vehicle_name']) ) {
    $vehicle_name = $_POST['vehicle_name'];
    $_SESSION['vehicle_name_temp'] = $vehicle_name;
  }
  else if ( isset($_SESSION['vehicle_name_temp']) ) {
    $vehicle_name = $_SESSION['vehicle_name_temp'];
  }
  else {
    $_SESSION['error_messages'][]="Vehicle name not found";
    die(header("Location: $BASE_URL"));
  }
  //$vehicle_name = $_POST['vehicle_name'];

  $sameprovider = FALSE;
  $extinct = FALSE;
  $notpublic = FALSE;


  $generalInfo = getVehicleActiveGeneralInformation($vehicle_name);
  $smarty->assign('generalInfo', $generalInfo);

  if($generalInfo['provider_username'] == $_SESSION['login'])
    $sameprovider = TRUE;
  $smarty->assign( 'sameprovider' ,  $sameprovider );

  if(!$generalInfo['vehicle_active'])
    $extinct = TRUE;
  $smarty->assign( 'extinct' ,  $extinct );

  if((!$generalInfo['vehicle_public']) AND (!$sameprovider))
    $notpublic = TRUE;
  $smarty->assign( 'notpublic' ,  $notpublic );

  $specifications = getVehicleActiveSpecifications($generalInfo['vehicle_id']);
  $smarty->assign( 'specifications' ,  $specifications );

  $communications = getVehicleCommunications($generalInfo['vehicle_id']);
  $smarty->assign( 'communications' ,  $communications );

  $sensors = getVehicleActiveSensors($generalInfo['vehicle_id']);
  $smarty->assign('sensors', $sensors);

  $resolutions_array = [];
  foreach($sensors as $sensor) {
    array_push($resolutions_array, getSensorActiveResolutions($sensor['sensor_id']));
  }
  $smarty->assign( 'resolutions_array' ,  $resolutions_array );

  $smarty->assign('PREVIOUSPAGE', $_SERVER['HTTP_REFERER']);
  $smarty->assign('menu', '3');
  $smarty->display('menu_vehicles/vehicle_pag.tpl');

?>
