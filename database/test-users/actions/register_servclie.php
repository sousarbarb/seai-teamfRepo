<?php
  // Include database connection and database functions libraries
  include_once( '../config/init.php' );
  include_once( $BASE_DIR . 'database/users.php' );

  // Checks if all fields where filled in the registration form
  if (!$_POST['client_username'] || !$_POST['client_password'] || 
      !$_POST['client_name'] || !$_POST['client_email'] || !$_POST['client_address'] || !$_POST['client_phone']) {
    // Assign to a session variable dedicated to error messages the error message
    $_SESSION['error_messages'][] = 'All fields are mandatory';

    // Retrieves all the camps filled in the form (to be user friendly)
    $_SESSION['form_values'] = $_POST;

    // Redirect to the registration page
    header("Location: $BASE_URL" . 'pages/test_users.php');
    exit;
  }

  // Stripping tags prevents scripts execution
  $username            = strip_tags($_POST['client_username']);
  $password            = $_POST['client_password'];
  $client_name         = strip_tags($_POST['client_name']);
  $client_email        = strip_tags($_POST['client_email']);
  $client_address      = strip_tags($_POST['client_address']);
  $client_phone_number = strip_tags($_POST['client_phone']);

  // Creating of a service client
  $result = createServiceClient($username, $password, 
                                $client_name, $client_email, $client_address, $client_phone_number);
  
  // Error handling
  switch ($result) {
    case -1:
      $_SESSION['error_messages'][] = 'Username already exists in the platform';
      break;
    case -2:
      $_SESSION['error_messages'][] = 'Client e-mail already is registered in the platform';
      break;
    case -3:
      $_SESSION['error_messages'][] = 'Client name already is defined in the database';
      break;
    case -4:
      $_SESSION['error_messages'][] = 'Insertion in the database was not possible';
      break;
  }

  // Action termination
  if( $result !== 0 ){
    header("Location: $BASE_URL" . 'pages/test_users.php');

    // Retrieves all the camps filled in the form (to be user friendly)
    $_SESSION['form_values'] = $_POST;
    
    exit;
  }
  else{
    $_SESSION['success_messages'][] = 'User registered successfully';
    header("Location: $BASE_URL");
  }
?>