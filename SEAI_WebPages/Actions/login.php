<?php
  include_once('../config/init.php');

  if (!$_POST['name'] || !$_POST['password']) {
    $_SESSION['error_messages'][] = 'Invalid login';
    $_SESSION['form_values'] = $_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  $name = $_POST['name'];
  $password = $_POST['password'];

  //if ($acc_type = isLoginCorrect($name, $password)) {
  if (1) { $acc_type = 'provider';
    $_SESSION['login'] = $name;
    $_SESSION['acc_type'] = $acc_type;
    if ($acc_type=='provider') {
      $_SESSION['entity_name'] = $name;
    }
    $_SESSION['success_messages'][] = 'Login successful';
  } else {
    $_SESSION['error_messages'][] = 'Login failed';
  }
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
?>
