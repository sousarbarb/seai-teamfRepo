<?php
  // Include database connection and database functions libraries
  include_once( '../config/init.php' );
  include_once( $BASE_DIR . 'database/users.php' );

  // Checks if all fields where filled in the registration form
  if (!$_POST['service_username'] || !$_POST['service_password'] || 
      !$_POST['entity_name'] || !$_POST['entity_email'] || !$_POST['entity_address'] || !$_POST['entity_phone'] || !$_POST['entity_logopath'] || 
      !$_POST['representative_name'] || !$_POST['representative_email'] || !$_POST['representative_phone']) {
    // Assign to a session variable dedicated to error messages the error message
    $_SESSION['error_messages'][] = 'All fields are mandatory';

    // Retrieves all the camps filled in the form (to be user friendly)
    $_SESSION['form_values'] = $_POST;

    // Redirect to the registration page
    header("Location: $BASE_URL" . 'pages/test_users.php');
    exit;
  }

  // Stripping tags prevents scripts execution
  $username               = strip_tags($_POST['service_username']);
  $password               = $_POST['service_password'];
  $entity_name            = strip_tags($_POST['entity_name']);
  $entity_email           = strip_tags($_POST['entity_email']);
  $entity_address         = strip_tags($_POST['entity_address']);
  $entity_phone_number    = strip_tags($_POST['entity_phone']);
  $entity_logo_path       = strip_tags($_POST['entity_logopath']);
  $represent_name         = strip_tags($_POST['representative_name']);
  $represent_email        = strip_tags($_POST['representative_email']);
  $represent_phone_number = strip_tags($_POST['representative_phone']);

  // Creating of a service provider
  $result = createServiceProvider($username, $password, 
                                  $entity_name, $entity_email, $entity_address, $entity_phone_number, $entity_logo_path,
                                  $represent_name, $represent_email, $represent_phone_number);
  
  // Error handling
  switch ($result) {
    case -1:
      $_SESSION['error_messages'][] = 'Username already exists in the platform';
      break;
    case -2:
      $_SESSION['error_messages'][] = 'Entity e-mail already is registered in the platform';
      break;
    case -3:
      $_SESSION['error_messages'][] = 'Entity name already is defined in the database';
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