<?php
include_once('../includes/database.php');

function checkUserPassword($username, $password) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT * FROM user WHERE username = ? AND password = ?');
  $stmt->execute(array($username, sha1($password)));
  return $stmt->fetch()?true:false;
}

function insertUser($username, $password,$email,$birth) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('INSERT INTO user (username,password,email) VALUES(?, ?, ?, ?)');
  $stmt->execute(array($username, sha1($password), $email,$birth));
}
 ?>
