<?php
include_once('../config/init.php');

$_SESSION['r_id'] = $_POST['request_id'];
die(header("Location:  $BASE_URL" . 'pages/request_pag.php'));

?>
