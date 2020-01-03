<?php
  include_once('../config/init.php');

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes  ($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
  }


  if (!$_POST['user'] || !$_POST['password']) {
    $_SESSION['error_messages'][] = 'Invalid login';
    $_SESSION['form_values'] = $_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  $user = test_input($_POST['user']);
  $password = test_input($_POST['password']);


try {
  $login_data = loginValidation($user);

  /*$login_data = [ //teste return DB
    "username"=>$user,
    "password"=>sha1($password),
    "status"=>"Active",
    "admin_id"=>"",
    "service_provider_id"=>"1",
    "service_provider_admin_perm"=>TRUE,
    "service_client_id"=>""
  ];*/

  //$login_data=[]; //teste return DB vazio

  if (empty($login_data)) {
    $_SESSION['error_messages'][] = 'Username Not Registered in the Platform';
	$_SESSION['l_count']= $_SESSION['l_count']+1;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  if (sha1($password) != $login_data['password']) {
    $_SESSION['error_messages'][] = 'Incorrect password';
	$_SESSION['l_count']= $_SESSION['l_count']+1;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  //if (1) { $acc_type = 'provider';
  if(!empty($login_data['admin_id'])) {
    $_SESSION['user_id'] = $login_data['admin_id'];
    $_SESSION['acc_type'] = "admin";
  } elseif(!empty($login_data['service_provider_id'])) {
    // Verify if an administrator already validated the service provider credentials!
    if ($login_data['service_provider_admin_perm'] == FALSE) {
      $_SESSION['error_messages'][] = 'Wait for an administrator to validate your account';
      // Retrieves all the camps filled in the form (to be user friendly)
      $_SESSION['form_values'] = $_POST;
      // Redirect to the previous page
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
    $_SESSION['user_id'] = $login_data['service_provider_id'];
    $_SESSION['acc_type'] = "provider";
  } elseif(!empty($login_data['service_client_id'])) {
    $_SESSION['user_id'] = $login_data['service_client_id'];
    $_SESSION['acc_type'] = "client";
  } else {
    $_SESSION['error_messages'][] = 'Unexpected Error Occurred';
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  // Check User status
  switch ($login_data['status']) {
    case 'Inactive':
      $_SESSION['error_messages'][] = 'Account inactive. Please contact the administrators in order to obtain more informations';
      $_SESSION['form_values'] = $_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
      break;
    case 'Waiting e-mail confirmation':
      $_SESSION['error_messages'][] = 'Go to your e-mail in order to valide the account';
      $_SESSION['form_values'] = $_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
      break;
  }

  /* //old teste
  $_SESSION['login'] = $user;
  $_SESSION['acc_type'] = $acc_type; //----deve vir da base de dados-----
  if ($acc_type=='provider') {
    $_SESSION['entity_name'] = "lsts"; //----deve vir da base de dados-----
  }*/
  $_SESSION['login'] = $user;
  $_SESSION['success_messages'][] = 'Login Successful';
  $_SESSION['l_count']=0;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
} catch (PDOException $e) {
  $_SESSION['error_messages'][] = 'Login Failed';
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}
?>
