<?php
  // Include database connection and database functions libraries
  include_once( '../config/init.php' );
  include_once( $BASE_DIR . 'database/users.php' );

  // Checks if all fields where filled in the registration form
  if (!$_POST['login_username'] || !$_POST['login_password']) {
    // Assign to a session variable dedicated to error messages the error message
    $_SESSION['error_messages'][] = 'All fields are mandatory';

    // Retrieves all the camps filled in the form (to be user friendly)
    $_SESSION['form_values'] = $_POST;

    // Redirect to the registration page
    header("Location: $BASE_URL" . 'pages/test_users.php');
    exit;
  }
  
  // Get user credentials
  $username = $_POST['login_username'];
  $password = $_POST['login_password'];

  // Checks the validation of credentials
  try{
    $user = loginValidation($username);

    // Username is registed in the platform?
    if($user == FALSE) {
      $_SESSION['error_messages'][] = 'Username not registed in the platform';
    
      // Retrieves all the camps filled in the form (to be user friendly)
      $_SESSION['form_values'] = $_POST;

      // Redirect to the previous page
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit;
    }

    // Incorrect password
    if( sha1($password) != $user['password'] ) {
      $_SESSION['error_messages'][] = 'Incorrect password';
    
      // Retrieves all the camps filled in the form (to be user friendly)
      $_SESSION['form_values'] = $_POST;
    } else {
      // If type of user is valid...
      if( $user['admin_id'] != NULL || $user['service_provider_id'] != NULL || $user['service_client_id'] != NULL ) {
        // Checks type of user
        // Administrator
        if( $user['admin_id'] != NULL )
          $type_user = 'Administrator';
        // Service Provider
        else if( $user['service_provider_id'] != NULL ) {
          $type_user = 'Service Provider';

          // Verify if an administrator already validate the service provider credentials!
          if ($user['service_provider_admin_perm'] == FALSE) {
            $_SESSION['error_messages'][] = 'Wait for an administrator to validate your account';
            // Retrieves all the camps filled in the form (to be user friendly)
            $_SESSION['form_values'] = $_POST;
            // Redirect to the previous page
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
          }

        }
        // Service Client
        else if( $user['service_client_id'] != NULL )
          $type_user = 'Service Client';
        
        // Check User status
        switch ($user['status']) {
          case 'Inactive':
            $_SESSION['error_messages'][] = 'Account inactive. Please contact the administrators in order to obtaine more informations';
            $_SESSION['form_values'] = $_POST;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
            
            break;

          case 'Waiting e-mail confirmation':
            $_SESSION['error_messages'][] = 'Go to your e-mail in order to valide the account';
            $_SESSION['form_values'] = $_POST;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;

            break;
        }

        // Successefull message
        $_SESSION['success_messages'][] = 'Login successful';
        // Login credentials informations - Debug purposes
        $_SESSION['success_messages'][] = "Username: $username - Password: $password - Type User: $type_user";
      }
      // If type of user invalid...
      else {
        $_SESSION['error_messages'][] = 'Type of user not defined / not valid / incorrect';
    
        // Retrieves all the camps filled in the form (to be user friendly)
        $_SESSION['form_values'] = $_POST;
      }
    }
  } catch (PDOException $e) {
    $_SESSION['error_messages'][] = 'Login failed';

    // Retrieves all the camps filled in the form (to be user friendly)
    $_SESSION['form_values'] = $_POST;
  }
  
  // Redirect to the previous page
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>