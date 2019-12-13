<?php
  include_once('../config/init.php');

  if (!$_POST['user'] || !$_POST['password']) {
    $_SESSION['error_messages'][] = 'Invalid login';
    $_SESSION['form_values'] = $_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  $name = $_POST['user'];
  $password = $_POST['password'];

  //if (isLoginCorrect($user, $password)) {
  if (1) { $acc_type = 'provider';
    $_SESSION['login'] = $name;
    $_SESSION['acc_type'] = $acc_type; //----deve vir da base de dados-----
    if ($acc_type=='provider') {
      $_SESSION['entity_name'] = "lsts"; //----deve vir da base de dados-----
    }
    $_SESSION['success_messages'][] = 'Login successful';
  } else {
    $_SESSION['error_messages'][] = 'Login failed';
  }
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
?>
