<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: darkred;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
include_once('registo.php');
$erro=100;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "*";
    $erros = $erros+1;
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
      $erros = $erros+1;
    }
  }

  if (empty($_POST["address"])) {
    $addressErr = "*";
    $erros = $erros+1;
  } else {
    $address = test_input($_POST["address"]);
    $erro=$erro-1;

  }

  if (empty($_POST["mail"])) {
    $mailErr = "*";
    $erros = $erros+1;
  } else {
    $mail = test_input($_POST["mail"]);
    // check if e-mail address is well-formed
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $mailErr = "Invalid email format";
      $erros = $erros+1;
    }
  }
  
  if (empty($_POST["phone"])) {
    $phoneErr = "*";
    $erros = $erros+1;
  } else {
    $phone = test_input($_POST["phone"]);
    if (!is_numeric ($phone)) {
      $phoneErr = "Only numbers!";
      $erros = $erros+1;
    }
  }

  if (empty($_POST["user"])) {
    $userErr = "*";
    $erros = $erros+1;
  } else {
    $user = test_input($_POST["user"]);
  }

  if (empty($_POST["pass"])) {
    $passErr = "*";
    $erros = $erros+1;
  } else {
    $pass = test_input($_POST["pass"]);
  }

  if (empty($_POST["pass2"])) {
    $pass2Err = "*";
    $erros = $erros+1;
  } else {
    $pass2 = test_input($_POST["pass2"]);
  }

  if ($_POST["pass"] != $_POST["pass2"]) {
    $passErr = "Passwords diferentes!";
    $pass2Err = "Passwords diferentes!";
    $erros = $erros+1;
  } else {
    $pass2 = test_input($_POST["pass2"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<div class="formulario">
<form method="post" action="opcao2.php">
<table class="tab">
<tr><td class="gg">
Name: </td><td><input type="text" name="name" value="<?php echo $name;?>">
  <span class="error"><?php echo $nameErr;?></span></td>
</tr>
<tr><td>
Address: </td><td><input type="text" name="address" value="<?php echo $address;?>">
  <span class="error"><?php echo $addressErr;?></span></td>
</tr>
<tr><td>
E-mail: </td><td><input type="text" name="mail" value="<?php echo $mail;?>">
  <span class="error"><?php echo $mailErr;?></span></td>
</tr>
<tr><td>
Phone Number: </td><td><input type="text" name="phone" value="<?php echo $phone;?>">
  <span class="error"><?php echo $phoneErr;?></span></td>
</tr>
<tr>
<tr>
</tr>
</tr>
<tr><td>
Username: </td><td><input type="text" name="user" value="<?php echo $user;?>">
  <span class="error"><?php echo $userErr;?></span></td>
</tr>
<tr><td>
Password: </td><td><input type='password' name="pass" value="<?php echo $pass;?>">
  <span class="error"><?php echo $passErr;?></span></td>
</tr>
<tr><td>
Confirm Password: </td><td><input type='password' name="pass2" value="<?php echo $pass2;?>">
  <span class="error"><?php echo $pass2Err;?></span></td>
</tr>
<tr><td>
  <input class="btn btn-info" type="submit" name="submit" value="Register">  
</td></tr>
</table>
</form>
</div>
<br>


<?php
if($erro<100) {
?><div class="info">Your registration request was successfully submited and you will soon receive an e-mail with the final approval.
<br>Click <a href="">here</a> to go back.
</div>
<?php  
}?>





<div class="exemplo">
<?php
if($erro<100) {
echo "<h2>Dados:</h2>";
echo $name;
echo "<br>";
echo $address;
echo "<br>";
echo $mail;
echo "<br>";
echo $phone;
echo "<br>";
echo $user;
echo "<br>";
echo $pass;
echo "<br>";
echo $pass2;
echo "<br>";
}
?>
</div>

</body>
</html>