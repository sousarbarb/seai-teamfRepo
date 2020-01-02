<?php
include_once('../config/init.php');

if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
  die(header('Location: index.php'));
} else {
  if($_POST){
    $vehicle_name = $_POST['vehicle_name'];
    $specification_id = $_POST['spec_id'];
    $valuemin = $_POST['spec_valuemin'];
    $valuemax = $_POST['spec_valuemax'];
    $comments = $_POST['spec_comments'];

    $smarty->assign('vehicle_name', $vehicle_name);
    $smarty->assign('specification_id', $specification_id);
    $smarty->assign('valuemin', $valuemin);
    $smarty->assign('valuemax', $valuemax);
    $smarty->assign('comments', $comments);
  }
  $smarty->assign('menu', '3');
  $smarty->display('menu_vehicles/editspecification.tpl');
}
?>
