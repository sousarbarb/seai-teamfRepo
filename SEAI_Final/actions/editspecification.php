<?php

include_once('../config/init.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes  ($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
}


    if ((empty($_POST["valuemin"])) || (ctype_space($_POST['valuemin']))) {
        $_SESSION['error_messages'][]="Value min required";
        $_SESSION['form_values']=$_POST;
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
    else {
        $valuemin = test_input($_POST["valuemin"]);
    }

    if ((empty($_POST["valuemax"])) || (ctype_space($_POST['valuemax']))) {
        $_SESSION['error_messages'][]="Value max required";
        $_SESSION['form_values']=$_POST;
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
    else {
        $valuemax = test_input($_POST["valuemax"]);
    }

    $comments = test_input($_POST['comments']);
    $specification_id = test_input($_POST['specification_id']);


    //guardar na DB todos os dados
    $result = editSpecification($specification_id, $valuemin, $valuemax, $comments);


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
