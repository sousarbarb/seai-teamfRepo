<?php
  // Include database connection and database functions libraries
  include_once( '../config/init.php' );
  include_once( $BASE_DIR . 'database/vehicles.php' );

  // Checks if all fields where filled in the registration form
  if( !$_POST['commun_type'] || !$_POST['commun_vehiclename'] ) {
    // Assign to a session variable dedicated to error messages the error message
    $_SESSION['error_messages'][] = 'All fields are mandatory';

    // Retrieves all the camps filled in the form (to be user friendly)
    $_SESSION['form_values'] = $_POST;

    // Redirect to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  // Stripping tags prevents scripts execution
  $commun_type  = strip_tags($_POST['commun_type']);
  $vehicle_name = strip_tags($_POST['commun_vehiclename']);

  // Creating new communication
  $result = createNewCommunicationAssociatedWithVehicle($commun_type, 
                                                        $vehicle_name);

  // Error handling
  switch ($result) {
    case -1:
      $_SESSION['error_messages'][] = "The vehicle specified by $vehicle_name isn't an active vehicle";
    break;
    case -2:
      $_SESSION['error_messages'][] = "The vehicle specified by $vehicle_name isn't defined in the database";
    break;
    case 1:
      $_SESSION['success_messages'][] = "Communication $commun_type already exists and is already linked with the vehicle";
    break;
    case 2:
      $_SESSION['success_messages'][] = "Inserting new communication $commun_type was successfully created";
    break;
  }

  if($result < 0){
    // Retrieves all the camps filled in the form (to be user friendly)
    $_SESSION['form_values'] = $_POST;
  }

  // Redirect to the previous page
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>