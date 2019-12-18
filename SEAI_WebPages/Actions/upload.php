<?php
$target_dir = "../files/";
$target_file = $target_dir . basename($_FILES["real-file"]["name"]);


if (file_exists($target_file)) {
    $_SESSION['error_messages'][]="File already exists";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
   }

if (($_FILES['real-file']['size'] == 0) && ($_FILES['real-file']['error'] == 0)) {
    $_SESSION['error_messages'][]="Entity file required";
    $_SESSION['form_values']=$_POST;
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  } else {


    if (move_uploaded_file($_FILES["real-file"]["tmp_name"], $target_file)) {
      $entity_image_path=$target_file;
    } else {
      $_SESSION['error_messages'][]="There was an error uploading your file";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
  }

  $_SESSION['success_messages'][]="File successfully uploaded";
      $_SESSION['form_values']=$_POST;
      die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    ?>
