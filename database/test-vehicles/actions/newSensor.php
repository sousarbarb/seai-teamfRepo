<?php
  // Include database connection and database functions libraries
  include_once( '../config/init.php' );
  include_once( $BASE_DIR . 'database/vehicles.php' );

  // Checks if all fields where filled in the registration form
  if (!$_POST['sensor_vehiclename'] || !$_POST['sensor_sensorname'] || 
      !$_POST['sensor_sensortype'] || !$_POST['sensor_comments'] ) {
    // Assign to a session variable dedicated to error messages the error message
    $_SESSION['error_messages'][] = 'All fields are mandatory';

    // Retrieves all the camps filled in the form (to be user friendly)
    $_SESSION['form_values'] = $_POST;

    // Redirect to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  // Stripping tags prevents scripts execution
  $vehicle_name = strip_tags($_POST['sensor_vehiclename']);
  $sensor_name  = strip_tags($_POST['sensor_sensorname']);
  $type         = strip_tags($_POST['sensor_sensortype']);
  $comments     = strip_tags($_POST['sensor_comments']);

  // Creating new sensor
  $result = createNewSensorAssociatedWithVehicle( $sensor_name, 
                                                  $type, 
                                                  $comments, 
                                                  $vehicle_name);

  // Error handling
  switch ($result) {
    case -1:
      $_SESSION['error_messages'][] = "The vehicle specified by $vehicle_name isn't an active vehicle";
    break;
    case -2:
      $_SESSION['error_messages'][] = "The vehicle specified by $vehicle_name isn't defined in the database";
    break;
    case -3:
      $_SESSION['error_messages'][] = "Sensor $sensor_name already exists and is active";
    break;
    case -4:
      $_SESSION['error_messages'][] = "Updating an existing sensor but inactive was not completed successfully";
    break;
    case -5:
      $_SESSION['error_messages'][] = "Inserting was not completed successfully";
    break;
    case 1:
      $_SESSION['success_messages'][] = "Updating an existing sensor but inactive was completed successfully";
    break;
    case 2:
      $_SESSION['success_messages'][] = "Insertion of a new sensor was completed successfully";
    break;
  }

  if($result < 0){
    // Retrieves all the camps filled in the form (to be user friendly)
    $_SESSION['form_values'] = $_POST;
  }

  // Redirect to the previous page
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>