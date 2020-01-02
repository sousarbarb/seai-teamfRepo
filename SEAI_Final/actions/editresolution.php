<?php

include_once('../config/init.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes  ($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
}


if ((empty($_POST["vel_sampling"])) || (ctype_space($_POST['vel_sampling']))) {
    $_SESSION['error_messages'][]="Val sampling required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}
else {
    $vel_sampling = test_input($_POST["vel_sampling"]);
}

if ((empty($_POST["consumption"])) || (ctype_space($_POST['consumption']))) {
    $_SESSION['error_messages'][]="Consumption required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}
else {
    $consumption = test_input($_POST["consumption"]);
}

if ((empty($_POST["swath"])) || (ctype_space($_POST['swath']))) {
    $_SESSION['error_messages'][]="Swath required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}
else {
    $swath = test_input($_POST["swath"]);
}

if ((empty($_POST["cost"])) || (ctype_space($_POST['cost']))) {
    $_SESSION['error_messages'][]="Cost required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}
else {
    $cost = test_input($_POST["cost"]);
}


    $comments = test_input($_POST['comments']);

    $sensor_id = test_input($_POST['sensor_id']);

    //guardar na DB todos os dados
    $result = editResolution($sensor_id, $vel_sampling, $consumption, $swath, $cost, $comments);


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
