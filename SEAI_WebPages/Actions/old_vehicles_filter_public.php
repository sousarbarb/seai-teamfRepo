<?php
include_once('../config/init.php');

$filtered_get = array_filter($_GET);
$arguments=[];

if(count($filtered_get)) {
  foreach($filtered_get as $key => $value) {
    array_push($arguments, $value);
  }
}

//chamar função database
//vehicles_filter_public($arguments);
print_r($arguments);

$_SESSION['form_values']=$_GET;
//die(header('Location: ' . $_SERVER['HTTP_REFERER']));

?>
