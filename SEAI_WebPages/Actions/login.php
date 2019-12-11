<?php
  include_once('../config/init.php');

  if (!$_POST['username'] || !$_POST['password']) {
    $_SESSION['error_messages'][] = 'Invalid login';
    $_SESSION['form_values'] = $_POST;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (isLoginCorrect($username, $password)) {
    $_SESSION['login'] = $username;
    $_SESSION['success_messages'][] = 'Login successful';
  } else {
    $_SESSION['error_messages'][] = 'Login failed';
  }
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
