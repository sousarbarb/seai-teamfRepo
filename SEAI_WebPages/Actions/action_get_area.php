<?php

include_once('../config/init.php');
$req = json_decode($_POST['parea'],true);
print_r($req);
header("Location: $BASE_URL". '/pages/show_previous_data.php');
?>
