<?php

include_once('../config/init.php');

function test_input($data) {
  $data = trim($data);
  $data = stripslashes  ($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_POST["selectform"]=='provider') {
  if (empty($_POST["entity"])) {
    $_SESSION['error_messages'][]="Entity name required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  } else {
    $entity = test_input($_POST["entity"]);
  }

  if (empty($_POST["address"])) {
    $_SESSION['error_messages'][]="Entity address required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  } else {
    $address = test_input($_POST["address"]);
  }

  if (empty($_POST["mail1"])) {
    $_SESSION['error_messages'][]="Entity email required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  } else {
    $mail1 = test_input($_POST["mail1"]);
    // check if e-mail address is well-formed
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['error_messages'][] = "Invalid entity email format";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
  }

  if (empty($_POST["phone"])) {
  $_SESSION['error_messages'][]="Entity phone number required";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  } else {
    $phone = test_input($_POST["phone"]);
    if ((!is_numeric ($phone)) || (!(preg_match('/^\+\d+$/', $phone)))) {
      $_SESSION['error_messages'][]="Entity phone number should be valid and contain a country calling code<br>following the pattern +[code][number]";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
  }

  if (empty($_POST["official"])) {
    $_SESSION['error_messages'][]="Representative name required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  } else {
    $official = test_input($_POST["official"]);
  }

  if (empty($_POST["mail2"])) {
    $_SESSION['error_messages'][]="Representative email required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  else {
    $mail2 = test_input($_POST["mail2"]);
    // check if e-mail address is well-formed
    if (!filter_var($mail2, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['error_messages'][] = "Invalid representative email format";
    }
  }

  if (empty($_POST["phone2"])) {
    $_SESSION['error_messages'][]="Representative phone number required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  } else {
    $phone2 = test_input($_POST["phone2"]);
    if ((!is_numeric ($phone2)) || (!(preg_match('/^\+\d+$/', $phone2)))) {
      $_SESSION['error_messages'][]="Representative phone number should be valid and contain a country calling code<br>following the pattern +[code][number]";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
  }

  if (empty($_POST["user"])) {
    $_SESSION['error_messages'][]="Username required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  else {
    $user = test_input($_POST["user"]);
  }

  if (empty($_POST["password"])) {
    $_SESSION['error_messages'][]="Password required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  else {
    $password = test_input($_POST["password"]);
  }

  if (empty($_POST["password2"])) {
    $_SESSION['error_messages'][]="Password confirmation required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  else {
    $password2 = test_input($_POST["password2"]);
  }

  if ($_POST["password"] != $_POST["password2"]) {
    $_SESSION['error_messages'][]="Passwords are diferent";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
} else {
  if (empty($_POST["name"])) {
    $_SESSION['error_messages'][]="Name required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  } else {
    $name = test_input($_POST["name"]);
  }

  if (empty($_POST["mail"])) {
    $_SESSION['error_messages'][]="Email required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  else {
    $mail = test_input($_POST["mail"]);
    // check if e-mail address is well-formed
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['error_messages'][] = "Invalid email format";
    }
  }

  if (empty($_POST["phone"])) {
    $_SESSION['error_messages'][]="Phone number required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  else {
      $phone = test_input($_POST["phone"]);
    if ((!is_numeric ($phone)) || (!(preg_match('/^\+\d+$/', $phone)))) {
      $_SESSION['error_messages'][]="Representative phone number should be valid and contain a country calling code<br>following the pattern +[code][number]";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
  }

  if (empty($_POST["user"])) {
    $_SESSION['error_messages'][]="Username required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  else {
    $user = test_input($_POST["user"]);
  }

  if (empty($_POST["password"])) {
    $_SESSION['error_messages'][]="Password required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  else {
    $password = test_input($_POST["password"]);
  }

  if (empty($_POST["password2"])) {
    $_SESSION['error_messages'][]="Password confirmation required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  else {
    $password2 = test_input($_POST["password2"]);
  }

  if ($_POST["password"] != $_POST["password2"]) {
    $_SESSION['error_messages'][]="Passwords are diferent";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
}

$_SESSION['success_messages'][]="Your registration request was successfully submited and you<br> will soon receive an e-mail with the final approval.
<br>Click <a href='{$BASE_URL}pages/index.php'>here</a> to go back";

if ($_POST["selectform"]=='provider') {
//enviar $entity, $address, $mail1, ... para a base de dados
//...
} else {
  //enviar apenas dados do client para a base de dados
}

$_SESSION['form_values']=$_POST;
die(header('Location: ' . $_SERVER['HTTP_REFERER']));

?>
