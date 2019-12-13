<?php

  function createUser_client($user, $password, $name, $email, $number) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users VALUES (?, ?, ?, ?)");
    $stmt->execute(array($user, sha1($password), $name, $email, $number));
  }

  function createUser_provider($user, $password, $name, $email, $number, $entity_name, $entity_address, $entity_email, $entity_number) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute(array($user, sha1($password), $name, $email, $number, $entity_name, $entity_address, $entity_email, $entity_number));
  }

  function isLoginCorrect($user, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT *
                            FROM users
                            WHERE user = ? AND password = ?");
    $stmt->execute(array($user, sha1($password)));
    return $stmt->fetch() == true;
  }
?>
