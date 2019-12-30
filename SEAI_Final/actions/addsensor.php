<?php

include_once('../config/init.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes  ($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
}
  
    if ((empty($_POST['name'])) || (ctype_space($_POST['name']))) {
        $_SESSION['error_messages'][]="Name required";
        $_SESSION['form_values']=$_POST;
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    } 
    else {
        $name = test_input($_POST["name"]);
        if (strlen($name)<2) {
            $_SESSION['error_messages'][]="Name should contain more than 2 characters";
            $_SESSION['form_values']=$_POST;
            die(header('Location: ' . $_SERVER['HTTP_REFERER']));
        }
    }

    if ((empty($_POST['type'])) || (ctype_space($_POST['type']))) {
        $_SESSION['error_messages'][]="Type required";
        $_SESSION['form_values']=$_POST;
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    } 
    else {
        $type = test_input($_POST["type"]);
        if (strlen($type)<2) {
            $_SESSION['error_messages'][]="Type should contain more than 2 characters";
            $_SESSION['form_values']=$_POST;
            die(header('Location: ' . $_SERVER['HTTP_REFERER']));
        }
    }


  
    $comments = test_input($_POST['comments']);

    $vehicle_name = test_input($_POST['vehicle_name']);
    
    //guardar na DB todos os dados
    $result = createNewSensorAssociatedWithVehicle($name, $type, $comments, $vehicle_name);
                     

    switch ($result) {
        case -1:
            $_SESSION['error_messages'][] = 'Vehicle is inactive';
            break;
        case -2:
            $_SESSION['error_messages'][] = 'Error checking for vehicle search';
            break;
        case -3:
            $_SESSION['error_messages'][] = 'Sensor is active';
            break;
        case -4:
            $_SESSION['error_messages'][] = 'Updating was not completed successfully';
            break;
         case -5:
            $_SESSION['error_messages'][] = 'Insertion was not completed successfully';
            break;
        case 1:
            $_SESSION['success_messages'][] = 'Updating an existing sensor but inactive was successfully';
            break;
        case 2:
            $_SESSION['success_messages'][] = 'Inserting a new sensor was completed successfully';
            break; 
    }
    if( $result > 0 ){
        $_SESSION['form_values']=$_POST;
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }

    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
?>