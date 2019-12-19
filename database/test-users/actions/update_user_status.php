<?php
  // Include database connection and database functions libraries
  include_once( '../config/init.php' );
  include_once( $BASE_DIR . 'database/users.php' );

  // Checks if all fields where filled in the registration form
  if (!$_POST['updatestatus_username'] || !$_POST['updatestatus_status']) {
    // Assign to a session variable dedicated to error messages the error message
    $_SESSION['error_messages'][] = 'All fields are mandatory';

    // Retrieves all the camps filled in the form (to be user friendly)
    $_SESSION['form_values'] = $_POST;

    // Redirect to the registration page
    header("Location: $BASE_URL" . 'pages/test_users.php');
    exit;
  }
  
  // Get user informations
  $username = $_POST['updatestatus_username'];
  $status   = $_POST['updatestatus_status'];

  // Update status
  try {
    if( editUserStatus($username, $status) > 0 ) {
      $_SESSION['success_messages'][] = "Username: $username - New Status: $status";
    } else {
      $_SESSION['error_messages'][] = 'Username not registed in the platform';
      // Retrieves all the camps filled in the form (to be user friendly)
      $_SESSION['form_values'] = $_POST;
    }
  }  catch (PDOException $e) {
    $_SESSION['error_messages'][] = 'Updating operation failed';
    // Retrieves all the camps filled in the form (to be user friendly)
    $_SESSION['form_values'] = $_POST;
  }

  // Return to initial page
  header("Location: $BASE_URL");
?>