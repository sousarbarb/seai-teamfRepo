<?php

include_once('../config/init.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes  ($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
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

    if ((empty($_POST["valuemin"])) || (ctype_space($_POST['valuemin']))) {
        $_SESSION['error_messages'][]="Value min required";
        $_SESSION['form_values']=$_POST;
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    } 
    else {
        $valuemin = test_input($_POST["valuemin"]);
        if ((!is_numeric ($valuemin))) {
            $_SESSION['error_messages'][]="Value min should be a float value";
            $_SESSION['form_values']=$_POST;
             die(header('Location: ' . $_SERVER['HTTP_REFERER']));
        }
    }

    if ((empty($_POST["valuemax"])) || (ctype_space($_POST['valuemax']))) {
        $_SESSION['error_messages'][]="Value max required";
        $_SESSION['form_values']=$_POST;
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    } 
    else {
        $valuemax = test_input($_POST["valuemax"]);
        if ((!is_numeric ($valuemax))) {
            $_SESSION['error_messages'][]="Value max should be a float value";
            $_SESSION['form_values']=$_POST;
            die(header('Location: ' . $_SERVER['HTTP_REFERER']));
        }
    }
  
    $comments = test_input($_POST['comments']);

    $vehicle_name = test_input($_POST['vehicle_name']);
    
    //guardar na DB todos os dados
    $result = createNewSpecificationAssociatedWithVehicle($type, $valuemin, $valuemax, $comments, $vehicle_name);
                     

    switch ($result) {
        case -1:
            $_SESSION['error_messages'][] = 'Vehicle is inactive';
            break;
        case -2:
            $_SESSION['error_messages'][] = 'Error checking for vehicle search';
            break;
        case -3:
            $_SESSION['error_messages'][] = 'specification is active';
            break;
        case -4:
            $_SESSION['error_messages'][] = 'Updating was not completed successfully';
            break;
         case -5:
            $_SESSION['error_messages'][] = 'Insertion was not completed successfully';
            break;
        case 1:
            $_SESSION['success_messages'][] = 'Updating an existing specification but inactive was successfully';
            break;
        case 2:
            $_SESSION['success_messages'][] = 'Inserting a new specification was completed successfully';
            break; 
    }
    if( $result > 0 ){
        $_SESSION['form_values']=$_POST;
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }

    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
?>