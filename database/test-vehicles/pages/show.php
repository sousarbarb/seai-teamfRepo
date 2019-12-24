<?php
  // Include database connection and database functions libraries
  include_once( '../config/init.php' );
  include_once( $BASE_DIR . 'database/vehicles.php' );

  // Get all vehicle names to facilitate new creations
  $vehicles_names = getAllVehiclesNames();
  $smarty->assign('vehicles_names', $vehicles_names);

  // Get vehicle name choosen by user
  if(isset($_POST['vehicle_name'])){
    $smarty->assign( 'vehicle_name_selected' ,  $_POST['vehicle_name'] );

    // Get general info
    $generalInfo = getVehicleGeneralInformation($_POST['vehicle_name']);
    $smarty->assign( 'generalInfo' ,  $generalInfo );

    // Get specifications
    $specifications = getVehicleSpecifications($generalInfo['vehicle_id']);
    $smarty->assign( 'specifications' ,  $specifications );

    // Get communications
    $communications = getVehicleCommunications($generalInfo['vehicle_id']);
    $smarty->assign( 'communications' ,  $communications );

    // Get sensors
    $sensors = getVehicleSensors($generalInfo['vehicle_id']);
    $smarty->assign( 'sensors' ,  $sensors );

    // Get all resolutions
    $resolutions_array = [];
    foreach($sensors as $sensor) {
      array_push($resolutions_array, getSensorResolutions($sensor['sensor_id']));
    }
    $smarty->assign( 'resolutions_array' ,  $resolutions_array );
  }


  // Display template refered to contacts
  $smarty->assign('PAGE', 'show');
  $smarty->display('show.tpl');
?>