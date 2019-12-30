<?php

include_once('../config/init.php');

function test_input($data) {
  $data = trim($data);
  $data = stripslashes  ($data);
  $data = htmlspecialchars($data);
  $data = strip_tags($data);
  return $data;
}

function send_mail_pass($email){
global $BASE_URL;

$to      = $email; // Send email to our user
$subject = 'Reset Password'; // Give the email a subject
$message = '

Please click this link to reset your password:
'. $BASE_URL .'pages/fpass_change.php?token=' . $email ;

// Our message

$headers = 'From:noreply@seaiteamf.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

}

echo $_POST["fmail"];

 

$result = verifyEmailExistance($_POST["fmail"]);
echo $result;

if($result==1){
	send_mail_pass($_POST["fmail"]);
	$_SESSION['success_messages'][]="Your reset password request was successfully submited and you will soon receive an e-mail to confirm it.
	 <br>Click <a href='{$BASE_URL}pages/index.php'>here</a> to go back";
}

else{
	$_SESSION['form_values']=$_POST;
	//die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}
?>
