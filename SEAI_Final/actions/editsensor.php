<?php

include_once('../config/init.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes  ($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
}


    if ((empty($_POST['sensor_name'])) || (ctype_space($_POST['sensor_name']))) {
        $_SESSION['error_messages'][]="Name required";
        $_SESSION['form_values']=$_POST;
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
    else {
        $sensor_name = test_input($_POST["sensor_name"]);
        if (strlen($sensor_name)<2) {
            $_SESSION['error_messages'][]="Name should contain more than 2 characters";
            $_SESSION['form_values']=$_POST;
            die(header('Location: ' . $_SERVER['HTTP_REFERER']));
        }
    }


    $comments = test_input($_POST['comments']);
    $sensor_id = test_input($_POST['sensor_id']);


    //guardar na DB todos os dados
    $result = editSensor($sensor_id, $sensor_name, $comments);


    switch ($result) {
        case -1:
            $_SESSION['error_messages'][] = 'Updating was not completed successfully';
            break;
        case 0:
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
