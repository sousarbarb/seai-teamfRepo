<?php

include_once('../config/init.php');

//if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
    //die(header('Location: index.php'));
  //} else {

    $entity_name = $_GET['entity_name'];

    $entity_user = getServiceProviderUsername($entity_name);

    $entity_info = getSpecificServiceProviderInfo($entity_user);
    $smarty->assign('entity_info', $entity_info);

    $smarty->assign('menu', '3');
    $smarty->display('menu_vehicles/entity_pag.tpl');
    //}

?>
