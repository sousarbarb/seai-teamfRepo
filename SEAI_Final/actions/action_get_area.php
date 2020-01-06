<?php

include_once('../config/init.php');
$req = json_decode($_POST['parea'],true);
$_SESSION["area"]=$req;
die(header('Location: ' . $BASE_URL . 'pages/show_previous_data.php'));
?>
