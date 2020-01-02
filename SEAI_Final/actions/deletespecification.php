<?php

include_once('../config/init.php');

    $specification_id = $_POST['specification_id'];
    $active = FALSE;

    editSpecificationActive($specification_id, $active);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    
?>