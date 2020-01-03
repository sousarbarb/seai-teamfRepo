<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  if($_POST){
    $vehicle_id   = $_POST['vehicle_id'];  
    $vehicle_name = $_POST['vehicle_name'];
    $localization = $_POST['localization'];   
    $comments = $_POST['comments'];  
    $vehicle_public = $_POST['vehicle_public']; 

    $smarty->assign('vehicle_id', $vehicle_id);
    $smarty->assign('vehicle_name', $vehicle_name);
    $smarty->assign('localization', $localization);
    $smarty->assign('comments', $comments);
    $smarty->assign('vehicle_public', $vehicle_public);
  }
  $smarty->assign('menu', '3');
  $smarty->display('menu_vehicles/editvehicle.tpl');
}
?>