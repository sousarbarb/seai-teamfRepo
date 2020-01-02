<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {

    $vehicle_id = $_POST['vehicle_id'];  
    $smarty->assign('vehicle_id', $vehicle_id);

    $vehicle_name = $_POST['vehicle_name'];  
    $smarty->assign('vehicle_name', $vehicle_name);

    $localization = $_POST['localization'];  
    $smarty->assign('localization', $localization);

    $comments = $_POST['comments'];  
    $smarty->assign('comments', $comments);

    $public = $_POST['public'];  
    $smarty->assign('public', $public);

    $smarty->assign('menu', '3');
    $smarty->display('menu_vehicles/editvehicle.tpl');
}
?>