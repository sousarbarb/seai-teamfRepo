<?php

include_once('../config/init.php');

function test_input($data) {
  $data = trim($data);
  $data = stripslashes  ($data);
  $data = htmlspecialchars($data);
  return $data;
}

function send_mail_provider($email,$username,$password,$entity){
$to      = $email; // Send email to our user
$subject = 'App Signup'; // Give the email a subject
$message = '

Thanks for signing up!
Your account has been created.
You can login with the following credentials:

------------------------
Username: '.$username.'
Password: '.$password.'
Entity: '.$entity.'
------------------------

Enjoy our app!

'; // Our message

$headers = 'From:noreply@seaiteamf.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

}


function send_mail_client($email,$username,$password){
$to      = $email; // Send email to our user
$subject = 'App Signup'; // Give the email a subject
$message = '

Thanks for signing up!
Your account has been created.
You can login with the following credentials:

------------------------
Username: '.$username.'
Password: '.$password.'
------------------------

Enjoy our app!

'; // Our message

$headers = 'From:noreply@seaiteamf.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

}


if ($_POST["selectform"]=='provider') {
  if ((empty($_POST['entity_name'])) || (ctype_space($_POST['entity_name']))) {
    $_SESSION['error_messages'][]="Entity name required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  } else {
    $entity_name = test_input($_POST["entity_name"]);
    if (strlen($entity_name)<3) {
      $_SESSION['error_messages'][]="Entity name should contain more than 3 characters";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
  }

  if ((empty($_POST["entity_address"])) || (ctype_space($_POST['entity_address']))) {
    $_SESSION['error_messages'][]="Entity address required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  } else {
    $entity_address = test_input($_POST["entity_address"]);
    if (strlen($entity_address)<10) {
      $_SESSION['error_messages'][]="Entity address should contain more than 10 characters";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
  }

  if ((empty($_POST["entity_email"])) || (ctype_space($_POST['entity_email']))) {
    $_SESSION['error_messages'][]="Entity email required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  } else {
    $entity_email = test_input($_POST["entity_email"]);
    // check if e-mail address is well-formed
    if (!filter_var($entity_email, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['error_messages'][] = "Invalid entity email format";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
  }

  if ((empty($_POST["entity_number"])) || (ctype_space($_POST['entity_number']))) {
  $_SESSION['error_messages'][]="Entity phone number required";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  } else {
    $entity_number = test_input($_POST["entity_number"]);
    if ((!is_numeric ($entity_number)) || (!(preg_match('/^\+\d+$/', $entity_number)))  || (strlen($entity_number)<5)) {
      $_SESSION['error_messages'][]="Entity phone number should be valid and contain a country calling code<br>following the pattern +[code][number]";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
  }

  if ((empty($_POST["name"])) || (ctype_space($_POST['name']))) {
    $_SESSION['error_messages'][]="Representative name required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  } else {
    $name = test_input($_POST["name"]);
    if ((strlen($name)<3) || !(preg_match('/^[a-zA-Z ]+$/', $name))) {
      $_SESSION['error_messages'][]="Representative name should contain more than 3 characters and should only contain letters";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
  }

  if ((empty($_POST["email"])) || (ctype_space($_POST['email']))) {
    $_SESSION['error_messages'][]="Representative email required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['error_messages'][] = "Invalid representative email format";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
  }

  if ((empty($_POST["number"])) || (ctype_space($_POST['number']))) {
    $_SESSION['error_messages'][]="Representative phone number required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  } else {
    $number = test_input($_POST["number"]);
    if ((!is_numeric ($number)) || (!(preg_match('/^\+\d+$/', $number))) || (strlen($number)<5)) {
      $_SESSION['error_messages'][]="Representative phone number should be valid and contain a country calling code<br>following the pattern +[code][number]";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
  }



} else {
  if ((empty($_POST["name"])) || (ctype_space($_POST['name']))) {
    $_SESSION['error_messages'][]="Name required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  } else {
    $name = test_input($_POST["name"]);
    if ((strlen($name)<3) || !(preg_match('/^[a-zA-Z ]+$/', $name))) {
      $_SESSION['error_messages'][]="Name should contain more than 3 characters and should only contain letters";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
  }

  if ((empty($_POST["email"])) || (ctype_space($_POST['email']))) {
    $_SESSION['error_messages'][]="Email required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['error_messages'][] = "Invalid email format";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
  }

  if ((empty($_POST["number"])) || (ctype_space($_POST['number']))) {
    $_SESSION['error_messages'][]="Phone number required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  else {
      $number = test_input($_POST["number"]);
    if ((!is_numeric ($number)) || (!(preg_match('/^\+\d+$/', $number))) || (strlen($number)<5)) {
      $_SESSION['error_messages'][]="Representative phone number should be valid and contain a country calling code<br>following the pattern +[code][number]";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
  }
}




if ((empty($_POST["user"])) || (ctype_space($_POST['user']))) {
  $_SESSION['error_messages'][]="Username required";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}
else {
  $user = test_input($_POST["user"]);
  if (strlen($user)<3)  {
    $_SESSION['error_messages'][]="Username should contain more than 3 characters";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
}

if ((empty($_POST["password"])) || (ctype_space($_POST['password']))) {
  $_SESSION['error_messages'][]="Password required";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}
else {
  $password = test_input($_POST["password"]);
  if (strlen($password)<7)  {
    $_SESSION['error_messages'][]="Password should contain more than 6 characters";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
}

if ((empty($_POST["password2"])) || (ctype_space($_POST['password2']))) {
  $_SESSION['error_messages'][]="Password confirmation required";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}
else {
  $password2 = test_input($_POST["password2"]);
}

if ($_POST["password"] != $_POST["password2"]) {
  $_SESSION['error_messages'][]="Passwords are diferent";
  $_SESSION['form_values']=$_POST;
  die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

//verificar se username não existe na base de dados
//...

$_SESSION['success_messages'][]="Your registration request was successfully submited and you<br> will soon receive an e-mail with the final approval.
<br>Click <a href='{$BASE_URL}pages/index.php'>here</a> to go back";

if ($_POST["selectform"]=='provider') {
//enviar tudo $entity_name, $entity_address, $entity_email, ... para a base de dados
//...
send_mail_provider($entity_email,$name ,$password,$entity_name);
} else {
  //enviar apenas dados do client para a base de dados
	send_mail_client($mail,$name ,$password);
}

$_SESSION['form_values']=$_POST;
die(header('Location: ' . $_SERVER['HTTP_REFERER']));

?>
