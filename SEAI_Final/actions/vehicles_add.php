<?php
include_once( '../config/init.php' );

function test_input($data) {
  $data = trim($data);
  $data = stripslashes  ($data);
  $data = htmlspecialchars($data);
  $data = strip_tags($data);
  return $data;
}

// Checks if all fields where filled in the registration form
if( !$_POST['vehicle_service_username'] || !$_POST['vehicle_name'] ||
    !$_POST['vehicle_public']) {
  // Assign to a session variable dedicated to error messages the error message
  $_SESSION['error_messages'][] = 'All fields are mandatory (except localization and comments)';

  // Retrieves all the camps filled in the form (to be user friendly)
  $_SESSION['form_values'] = $_POST;

  // Redirect to the previous page
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

// Test inputs to prevent scripts execution
$provider_username = test_input($_POST['vehicle_service_username']);
$vehicle_name      = test_input($_POST['vehicle_name']);
$localization      = test_input($_POST['vehicle_localization']);
$comments          = test_input($_POST['vehicle_comments']);
$public            = test_input($_POST['vehicle_public']);

// Creating new vehicle
$result = createVehicle($vehicle_name,
                        $localization,
                        $comments,
                        ($public == 'y')? TRUE:FALSE,
                        $provider_username);

// Error handling
switch ($result) {
  case -1:
    $_SESSION['error_messages'][] = "$provider_username isn't approved by an administrator";
  break;
  case -2:
    $_SESSION['error_messages'][] = "$provider_username isn't registed in the platform";
  break;
  case -3:
    $_SESSION['error_messages'][] = "The vehicle $vehicle_name already exists but $provider_username does not own that vehicle";
  break;
  case -4:
    $_SESSION['error_messages'][] = "The vehicle $vehicle_name is owned by $provider_username but it is an active vehicle";
  break;
  case -5:
    $_SESSION['error_messages'][] = "Updating an existing vehicle but inactive was not completed successfully";
  break;
  case -6:
    $_SESSION['error_messages'][] = "Insertion was not completed successfully";
  break;
  case 1:
    $_SESSION['success_messages'][] = "Updating an existing vehicle but inactive was completed successfully";
  break;
  case 2:
    $_SESSION['success_messages'][] = "Insertion of a new vehicle was completed successfully";
  break;
}

if($result < 0){
  // Retrieves all the camps filled in the form (to be user friendly)
  $_SESSION['form_values'] = $_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

die(header('Location: ' . $BASE_URL.'pages/menu_my_vehicles.php'));
?>
