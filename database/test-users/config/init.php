<?php
  // Cookies and session configuration
  session_set_cookie_params(3600, '/seai/test-users/');
  session_start();              // directory in the web server (localhost/seai/test-users/)

  // BASE DIRECTORIES - to not conflit with the different directories necessary to the website
  $BASE_DIR = 'C:/xampp/htdocs/seai/test-users/';
  $BASE_URL = 'http://localhost/seai/test-users/';

  // Database connection
  $conn = new PDO('pgsql:host=128.199.59.162;dbname=seai', 'sousa', 'sousa');
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);  // Enables by default the associative fetch mode from queries
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       // Enables the exception handling mechanism

  // Error messages handling
  if (isset($_SESSION['error_messages'])) {
    $ERROR_MESSAGES = $_SESSION['error_messages'];
    unset($_SESSION['error_messages']);
  }

  // Success messages handling
	if (isset($_SESSION['success_messages'])) {
		$SUCCESS_MESSAGES = $_SESSION['success_messages'];
		unset($_SESSION['success_messages']);
	}

  // Automatic fill in register form
  if (isset($_SESSION['form_values'])) {
    $FORM_VALUES = $_SESSION['form_values'];
    unset($_SESSION['form_values']);
  }
?>