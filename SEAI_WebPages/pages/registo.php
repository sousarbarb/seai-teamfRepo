
<!doctype html>
<html lang="pt-br">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
  
<head>
<meta charset="utf-8">
<title>Registo</title>
</head>
<?php
session_start();
?>
<body>

<div class="reg"><strong>Registration</strong></div>

<div class="service">  
<form method="post" name="form1" id="form1">
    <p>
        <strong>Type of user:&nbsp;&nbsp;&nbsp;</strong>
        <input type="radio" name="selectedfaucet" id="radio" value="servp">
        <label for="radio">Service Provider&nbsp;&nbsp;</label>
    
        <input type="radio" name="selectedfaucet" id="" value="servc">
        <label for="radio2">Service Client</label>
    </p>
</form>
</div>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script>
 $(document).ready(function() { 
   $('input[name=selectedfaucet]').change(function(){
        $('form').submit();
   });
  });
</script>
</body>
</html>

<?php
if ((($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST))) {
    if($_POST['selectedfaucet'] == "servp") {
        header("location:registo_provider.php");
    }
    else if($_POST['selectedfaucet'] == "servc") {
        header("location:registo_client.php");
    }
}
?>
