<?php

include_once('../config/init.php');

    $vehicle_id = $_POST['id_vehicle'];
    $communication_id = $_POST['communication_id'];

    deleteVehicleCommunication($vehicle_id, $communication_id);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    
?>