<?php
  include_once('../config/init.php');

  if (!$_POST['name'] || !$_POST['password']) {
    $_SESSION['error_messages'][] = 'Invalid login';
    $_SESSION['form_values'] = $_POST;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  $username = $_POST['name'];
  $password = $_POST['password'];

  //if (isLoginCorrect($name, $password)) {
  if (1) {
    $_SESSION['login'] = $name;
    $_SESSION['success_messages'][] = 'Login successful';
  } else {
    $_SESSION['error_messages'][] = 'Login failed';
  }
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
