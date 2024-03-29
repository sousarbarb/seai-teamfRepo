<?php
  // Include database connection and database functions libraries
  include_once( '../config/init.php' );
  include_once( $BASE_DIR . 'database/vehicles.php' );

  /**************************
   ***** SEARCH FILTERS *****
   **************************/
  // Get all service providers approved by an administrator
  if(isset($_POST['service_providers_array'])){
    $smarty->assign( 'service_providers_selected' ,  $_POST['service_providers_array'] );
    $service_providers_selected = $_POST['service_providers_array'];
  }
  $service_providers = getAllApprovalServiceProviders();
  $smarty->assign('service_providers', $service_providers);

  // Get all distinct active specifications
  if(isset($_POST['specifications_array'])){
    $smarty->assign( 'specifications_selected' ,  $_POST['specifications_array'] );
    $specifications_selected = $_POST['specifications_array'];
  }
  $specifications = getAllActiveDistinctSpecifications();
  $smarty->assign('specifications', $specifications);

  // Get all distinct types of communications
  if(isset($_POST['communications_array'])){
    $smarty->assign( 'communications_selected' ,  $_POST['communications_array'] );
    $communications_selected = $_POST['communications_array'];
  }
  $communications = getAllCommunicationTypes();
  $smarty->assign('communications', $communications);

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



  // SEARCHING FILTERS
  $search_results = searchVehiclesWithFilters(
    NULL,       // Vehicles Active: NULL (restriction not activated)
                //                  FALSE (only show inactive vehicles)
                //                  TRUE (only show active vehicles)
    NULL,       // Vehicles APPROVED: NULL (restriction not activated)
                //                    FALSE (only show unapproved vehicles)
                //                    TRUE (only show approved vehicles)
    NULL,       // Vehicles PUBLIC: NULL (restriction not activated)
                //                  FALSE (only show private vehicles)
                //                  TRUE (only show public vehicles)
    isset($service_providers_selected)? $service_providers_selected : NULL,
    isset($specifications_selected)?    $specifications_selected    : NULL,
    isset($communications_selected)?    $communications_selected    : NULL,
    isset($sensors_selected)?           $sensors_selected           : NULL,
    isset($resolutions_selected)?       $resolutions_selected       : NULL
  );
  $smarty->assign('search_results', $search_results);



  // Display template refered to contacts
  $smarty->assign('PAGE', 'search');
  $smarty->display('search.tpl');
?>