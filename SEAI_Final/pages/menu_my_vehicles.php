<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  $approved = NULL;
  if(isset($_POST['approvals_array'])){
    $smarty->assign( 'approvals_selected' ,  $_POST['approvals_array'] );
    $approvals_selected = $_POST['approvals_array'];

    if (count($approvals_selected)==1) {
      if ($approvals_selected[0] == 'Approved') {
        $approved = TRUE;
      } else {
        $approved = FALSE;
      }
    }
  }
  $approvals = ['Approved', 'Not Approved'];
  $smarty->assign('approvals', $approvals);

  /*
  // Get all service providers approved by an administrator
  if(isset($_POST['service_providers_array'])){
    $smarty->assign( 'service_providers_selected' ,  $_POST['service_providers_array'] );
    $service_providers_selected = $_POST['service_providers_array'];
  }
  $service_providers = getAllApprovalServiceProviders();
  $smarty->assign('service_providers', $service_providers);
  */

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

  $info = getSpecificServiceProviderInfo($smarty->getTemplateVars('login'));
  $service_providers_selected = array($info['entity_name']);
  $search_results = searchVehiclesWithFilters(
    TRUE,       // Vehicles Active: NULL (restriction not activated)
                //                  FALSE (only show inactive vehicles)
                //                  TRUE (only show active vehicles)
    $approved,       // Vehicles APPROVED: NULL (restriction not activated)
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
  $smarty->assign('search_results',$search_results);
  $smarty->assign('menu', '3');
  $smarty->display('menu_vehicles/menu_my_vehicles.tpl');
}
?>
