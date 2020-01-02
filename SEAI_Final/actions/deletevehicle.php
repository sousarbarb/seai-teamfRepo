<?php

include_once('../config/init.php');

    $vehicle_id = $_POST['vehicle_id'];
    $active = FALSE;

    editVehicleActive($vehicle_id, $active);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    
?>