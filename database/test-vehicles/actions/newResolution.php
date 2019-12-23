<?php
  // Include database connection and database functions libraries
  include_once( '../config/init.php' );
  include_once( $BASE_DIR . 'database/vehicles.php' );

  // Checks if all fields where filled in the registration form
  if( !$_POST['res_sensorid'] || !$_POST['res_resolution'] || 
      !$_POST['res_velocity'] || !$_POST['res_consumption'] || 
      !$_POST['res_swath'] || !$_POST['res_cost']) {
    // Assign to a session variable dedicated to error messages the error message
    $_SESSION['error_messages'][] = 'All fields are mandatory (except comments)';

    // Retrieves all the camps filled in the form (to be user friendly)
    $_SESSION['form_values'] = $_POST;

    // Redirect to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  // Stripping tags prevents scripts execution
  $sensorid    = strip_tags($_POST['res_sensorid']);
  $resolution  = strip_tags($_POST['res_resolution']);
  $velocity    = strip_tags($_POST['res_velocity']);
  $consumption = strip_tags($_POST['res_consumption']);
  $swath       = strip_tags($_POST['res_swath']);
  $cost        = strip_tags($_POST['res_cost']);
  $comments    = strip_tags($_POST['res_comments']);

  // Creating new resolution
  $result = createNewResolutionAssociatedWithSensor($resolution, 
                                                    $velocity, 
                                                    $consumption, 
                                                    $swath, 
                                                    $cost, 
                                                    $comments, 
                                                    $sensorid);

  // Error handling
  switch($result) {
    case -1:
      $_SESSION['error_messages'][] = "Resolution $resolution already exists and is active";
    break;
    case -2:
      $_SESSION['error_messages'][] = "Updating an existing resolution but inactive was not completed successfully";
    break;
    case -3:
      $_SESSION['error_messages'][] = "Inserting was not completed successfully";
    break;
    case 1:
      $_SESSION['success_messages'][] = "Updating an existing resolution but inactive was completed successfully";
    break;
    case 2:
      $_SESSION['success_messages'][] = "Insertion of a new resolution was completed successfully";
    break;
  }

  if($result < 0){
    // Retrieves all the camps filled in the form (to be user friendly)
    $_SESSION['form_values'] = $_POST;
  }

  // Redirect to the previous page
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>