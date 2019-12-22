<?php
  // Cookies and session configuration
  session_set_cookie_params(3600, '/seai/test-vehicles/');
  session_start();              // directory in the web server (localhost/seai/test-vehicles/)

  // BASE DIRECTORIES - to not conflit with the different directories necessary to the website
  $BASE_DIR = 'C:/xampp/htdocs/seai/test-vehicles/';
  $BASE_URL = 'http://localhost/seai/test-vehicles/';

  // Include SMARTY library - necessary to compile the templates made
  include_once($BASE_DIR . 'lib/smarty/Smarty.class.php');

  // Database connection
  $conn = new PDO('pgsql:host=128.199.59.162;dbname=seai', 'sousa', 'sousa');
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);  // Enables by default the associative fetch mode from queries
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       // Enables the exception handling mechanism

  // Start Smarty
  $smarty = new Smarty;
  $smarty->template_dir = $BASE_DIR . 'templates/';
  $smarty->compile_dir  = $BASE_DIR . 'templates_c/';
  // Assign new variables in Smarty
  $smarty->assign('BASE_DIR', $BASE_DIR);
  $smarty->assign('BASE_URL', $BASE_URL);

  // Error messages handling
  if (isset($_SESSION['error_messages'])) {
    $smarty->assign( 'ERROR_MESSAGES' ,  $_SESSION['error_messages'] );
    unset($_SESSION['error_messages']);
  }

  // Success messages handling
	if (isset($_SESSION['success_messages'])) {
    $smarty->assign( 'SUCCESS_MESSAGES' ,  $_SESSION['success_messages'] );
		unset($_SESSION['success_messages']);
	}

  // Automatic fill in register form
  if (isset($_SESSION['form_values'])) {
    $smarty->assign( 'FORM_VALUES' ,  $_SESSION['form_values'] );
    unset($_SESSION['form_values']);
  }
?>