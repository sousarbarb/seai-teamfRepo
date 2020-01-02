<?php

include_once('../config/init.php');

    $resolution_id = $_POST['resolution_id'];
    $active = FALSE;

    editResolutionActive($resolution_id, $active);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    
?>