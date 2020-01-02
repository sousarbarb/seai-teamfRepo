<?php

include_once('../config/init.php');

    $sensor_id = $_POST['sensor_id'];
    $active = FALSE;

    editSensorActive($sensor_id, $active);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    
?>