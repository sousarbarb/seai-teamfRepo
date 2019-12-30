<?php

include_once('../config/init.php');

//if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
    //die(header('Location: index.php'));
  //} else {

    //$vehicle_name = $_GET['vehicle_name'];

    //$smarty->assign('vehicle_name', $vehicle_name);

    $smarty->assign('menu', '3');
    $smarty->display('menu_vehicles/addspecification.tpl');
    //}

?>