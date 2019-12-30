<?php

include_once('../config/init.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes  ($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
}
  
if ((empty($_POST["value"])) || (ctype_space($_POST['value']))) {
    $_SESSION['error_messages'][]="Value required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
} 
else {
    $value = test_input($_POST["value"]);
    if ((!is_numeric ($value))) {
        $_SESSION['error_messages'][]="Value should be a float value";
        $_SESSION['form_values']=$_POST;
         die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
}

if ((empty($_POST["vel_sampling"])) || (ctype_space($_POST['vel_sampling']))) {
    $_SESSION['error_messages'][]="Val sampling min required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
} 
else {
    $vel_sampling = test_input($_POST["vel_sampling"]);
    if ((!is_numeric ($vel_sampling))) {
        $_SESSION['error_messages'][]="Value sampling should be a float value";
        $_SESSION['form_values']=$_POST;
         die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
}

if ((empty($_POST["consumption"])) || (ctype_space($_POST['consumption']))) {
    $_SESSION['error_messages'][]="Consumption required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
} 
else {
    $consumption = test_input($_POST["consumption"]);
    if ((!is_numeric ($consumption))) {
        $_SESSION['error_messages'][]="Consumption should be a float value";
        $_SESSION['form_values']=$_POST;
         die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
}

if ((empty($_POST["swath"])) || (ctype_space($_POST['swath']))) {
    $_SESSION['error_messages'][]="Swath required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
} 
else {
    $swath = test_input($_POST["swath"]);
    if ((!is_numeric ($swath))) {
        $_SESSION['error_messages'][]="Swath should be a float value";
        $_SESSION['form_values']=$_POST;
         die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
}

if ((empty($_POST["cost"])) || (ctype_space($_POST['cost']))) {
    $_SESSION['error_messages'][]="Cost required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
} 
else {
    $cost = test_input($_POST["cost"]);
    if ((!is_numeric ($cost))) {
        $_SESSION['error_messages'][]="Cost should be a float value";
        $_SESSION['form_values']=$_POST;
         die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
}

  
    $comments = test_input($_POST['comments']);

    $sensor_id = test_input($_POST['sensor_id']);
    
    //guardar na DB todos os dados
    $result = createNewResolutionAssociatedWithSensor($value, $vel_sampling, $consumption, $swath, $cost, $comments, $sensor_id);
                     

    switch ($result) {
        case -1:
            $_SESSION['error_messages'][] = 'Resolution is active';
            break;
        case -2:
            $_SESSION['error_messages'][] = 'Updating was not completed successfully';
            break;
         case -3:
            $_SESSION['error_messages'][] = 'Insertion was not completed successfully';
            break;
        case 1:
            $_SESSION['success_messages'][] = 'Updating an existing sensor but inactive was successfully';
            break;
        case 2:
            $_SESSION['success_messages'][] = 'Inserting a new resolution was completed successfully';
            break; 
    }
    if( $result > 0 ){
        $_SESSION['form_values']=$_POST;
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }

    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
?>