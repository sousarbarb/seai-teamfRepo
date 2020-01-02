<?php

include_once('../config/init.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes  ($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
}
  

    if ((empty($_POST['vehicle_name'])) || (ctype_space($_POST['vehicle_name']))) {
        $_SESSION['error_messages'][]="Vehicle name required";
        $_SESSION['form_values']=$_POST;
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    } 
    else {
        $vehicle_name = test_input($_POST["vehicle_name"]);
        if (strlen($vehicle_name)<2) {
            $_SESSION['error_messages'][]="Vehicle name should contain more than 2 characters";
            $_SESSION['form_values']=$_POST;
            die(header('Location: ' . $_SERVER['HTTP_REFERER']));
        }
    }


    $public = test_input($_POST['vehicle_public']);
    ($public == 'y')? TRUE:FALSE;


    $localization = test_input($_POST['localization']);
    $comments = test_input($_POST['comments']);
    $vehicle_id = test_input($_POST['vehicle_id']);

    
    //guardar na DB todos os dados
    $result = editVehicle($vehicle_id, $vehicle_name, $localization, $comments, $public);
                     

    switch ($result) {
        case -1:
            $_SESSION['error_messages'][] = 'Updating was not completed successfully';
            break;
        case 1:
            $_SESSION['success_messages'][] = 'Updating was successful';
            break;
    }
    if($result == 0 ){
        $_SESSION['form_values']=$_POST;
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }

    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
?>