<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
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
  $smarty->assign('search_results',$search_results);
  $smarty->assign('menu', '3');
  $smarty->display('menu_admin/vehicles_manage.tpl');
}
?>
