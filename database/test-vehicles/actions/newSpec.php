<?php
  // Include database connection and database functions libraries
  include_once( '../config/init.php' );
  include_once( $BASE_DIR . 'database/vehicles.php' );

  // Checks if all fields where filled in the registration form
  if (!$_POST['spec_vehiclename'] || !$_POST['spec_spectype'] || 
      !$_POST['spec_minvalue'] || !$_POST['spec_maxvalue'] || 
      !$_POST['spec_comments']) {
    // Assign to a session variable dedicated to error messages the error message
    $_SESSION['error_messages'][] = 'All fields are mandatory';

    // Retrieves all the camps filled in the form (to be user friendly)
    $_SESSION['form_values'] = $_POST;

    // Redirect to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  // Stripping tags prevents scripts execution
  $vehicle_name = strip_tags($_POST['spec_vehiclename']);
  $spec_type    = strip_tags($_POST['spec_spectype']);
  $min_value    = strip_tags($_POST['spec_minvalue']);
  $max_value    = strip_tags($_POST['spec_maxvalue']);
  $comments     = strip_tags($_POST['spec_comments']);

  // Creating new specification
  $result = createNewSpecificationAssociatedWithVehicle($spec_type, 
                                                        $min_value, 
                                                        $max_value, 
                                                        $comments, 
                                                        $vehicle_name);
  
  // Error handling
  switch($result) {
    case -1:
      $_SESSION['error_messages'][] = "The vehicle specified $vehicle_name isn't an active vehicle";
    break;
    case -2:
      $_SESSION['error_messages'][] = "The vehicle specified by $vehicle_name isn't defined in the database";
    break;
    case -3:
      $_SESSION['error_messages'][] = "Specification type $spec_type already exists and is active";
    break;
    case -4:
      $_SESSION['error_messages'][] = "Updating an existing specification but inactive was not completed successfully";
    break;
    case -5:
      $_SESSION['error_messages'][] = "Inserting was not completed successfully";
    break;
    case 1:
      $_SESSION['success_messages'][] = "Updating an existing specification but inactive was completed successfully";
    break;
    case 2:
      $_SESSION['success_messages'][] = "Insertion of a new specification was completed successfully";
    break;
  }

  if($result < 0){
    // Retrieves all the camps filled in the form (to be user friendly)
    $_SESSION['form_values'] = $_POST;
  }

  // Redirect to the previous page
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>