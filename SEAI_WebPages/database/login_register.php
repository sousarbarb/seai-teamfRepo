<?php

  function createUser_client($name, $password, $email, $number) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users VALUES (?, ?, ?, ?)");
    $stmt->execute(array($name, sha1($password), $email, $number));
  }

  function createUser_provider($name, $password, $email, $number, $entity_name, $entity_address, $entity_email, $entity_number) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute(array($name, sha1($password), $email, $number, $entity_name, $entity_address, $entity_email, $entity_number));
  }

  function isLoginCorrect($name, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT *
                            FROM users
                            WHERE name = ? AND password = ?");
    $stmt->execute(array($name, sha1($password)));
    return $stmt->fetch() == true;
  }
?>
