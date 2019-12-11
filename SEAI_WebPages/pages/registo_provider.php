<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: darkred;}
</style>
</head>
<body>

<?php
$erro=100;
// define variables and set to empty values
include_once('registo.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["entity"])) {
    $entityErr = "*";
    $erro=$erro+1;
  } else {
    $entity = test_input($_POST["entity"]);
    $erro=$erro-1;
  }

  if (empty($_POST["address"])) {
    $addressErr = "*";
    $erro=$erro+1;
  } else {
    $address = test_input($_POST["address"]);
  }

  if (empty($_POST["mail"])) {
    $mailErr = "*";
    $erro=$erro+1;
  } else {
    $mail = test_input($_POST["mail"]);
    // check if e-mail address is well-formed
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $mailErr = "Invalid email format";
      $erro=$erro+1;
    }
  }

  if (empty($_POST["phone"])) {
    $phoneErr = "*";
    $erro=$erro+1;
  } else {
    $phone = test_input($_POST["phone"]);
    if (!is_numeric ($phone)) {
      $phoneErr = "Only numbers!";
      $erro=$erro+1;
    }
  }

  if (empty($_POST["official"])) {
    $offErr = "*";
    $erro=$erro+1;
  } else {
    $official = test_input($_POST["official"]);
  }

  if (empty($_POST["mail2"])) {
    $mail2Err = "*";
    $erro=$erro+1;
  }
  else {
    $mail2 = test_input($_POST["mail2"]);
    // check if e-mail address is well-formed
    if (!filter_var($mail2, FILTER_VALIDATE_EMAIL)) {
      $mail2Err = "Invalid email format";
      $erro=$erro+1;
    }
  }

  if (empty($_POST["phone2"])) {
    $phone2Err = "*";
    $erro=$erro+1;
  }
  else {
      $phone2 = test_input($_POST["phone2"]);
    if (!is_numeric ($phone2)) {
      $phone2Err = "Only numbers!";
      $erro=$erro+1;
    }
  }

  if (empty($_POST["user"])) {
    $userErr = "*";
    $erro=$erro+1;
  }
  else {
    $user = test_input($_POST["user"]);
  }

  if (empty($_POST["pass"])) {
    $passErr = "*";
    $erro=$erro+1;
  }
  else {
    $pass = test_input($_POST["pass"]);
  }

  if (empty($_POST["pass2"])) {
    $pass2Err = "*";
    $erro=$erro+1;
  }
  else {
    $pass2 = test_input($_POST["pass2"]);
  }

  if ($_POST["pass"] != $_POST["pass2"]) {
    $passErr = "Passwords diferentes!";
    $pass2Err = "Passwords diferentes!";
    $erro=$erro+1;
  }
  else {
    $pass2 = test_input($_POST["pass2"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes  ($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<div class="formulario">
<form method="post" action="opcao1.php">
<table class="tab">
<tr><td class="gg">
Entity Name: </td><td><input type="text" class="register" name="entity" value="<?php echo $entity;?>">
  <span class="error"><?php echo $entityErr;?></span></td>
</tr>
<tr><td>
Address: </td><td><input type="text" class="register" name="address" value="<?php echo $address;?>">
  <span class="error"><?php echo $addressErr;?></span></td>
</tr>
<tr><td>
E-mail: </td><td><input type="text" class="register" name="mail" value="<?php echo $mail;?>">
  <span class="error"><?php echo $mailErr;?></span></td>
</tr>
<tr><td>
Phone Number: </td><td><input type="text" class="register" name="phone" value="<?php echo $phone;?>">
  <span class="error"><?php echo $phoneErr;?></span></td>
</tr>
<tr>
<tr>
</tr>
</tr>
<tr><td>
Official Representative: </td><td><input type="text" class="register" name="official" value="<?php echo $official;?>">
  <span class="error"><?php echo $offErr;?></span></td>
</tr>
<tr><td>
E-mail: </td><td><input type="text" class="register" name="mail2" value="<?php echo $mail2;?>">
  <span class="error"><?php echo $mail2Err;?></span></td>
</tr>
<tr><td>
Phone Number: </td><td><input type="text" class="register" name="phone2" value="<?php echo $phone2;?>">
  <span class="error"><?php echo $phone2Err;?></span></td>
</tr>
<tr>
<tr>
</tr>
</tr>
<tr><td>
Username: </td><td><input type="text" class="register" name="user" value="<?php echo $user;?>">
  <span class="error"><?php echo $userErr;?></span></td>
</tr>
<tr><td>
Password: </td><td><input type='password' class="register" name="pass" value="<?php echo $pass;?>">
  <span class="error"><?php echo $passErr;?></span></td>
</tr>
<tr><td>
Confirm Password: </td><td><input type='password' class="register" name="pass2" value="<?php echo $pass2;?>">
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
echo $entity;
echo "<br>";
echo $address;
echo "<br>";
echo $mail;
echo "<br>";
echo $phone;
echo "<br>";
echo $official;
echo "<br>";
echo $mail2;
echo "<br>";
echo $phone2;
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
