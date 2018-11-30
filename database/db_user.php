<?php
include_once('../includes/database.php');

function checkUserPassword($username, $password) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT * FROM user WHERE username = ? AND password = ?');
  $stmt->execute(array($username, sha1($password)));
  return $stmt->fetch()?true:false;
}

function checkUsernameExists($username) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
  $stmt->execute(array($username));
  return $stmt->fetch()?true:false;
}

function getUsernameFromId($id) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT username FROM user WHERE ID = ?');
  $stmt->execute(array($id));
  return $stmt->fetch()['username'];
}

function getIdFromUsername($username) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT ID FROM user WHERE username = ?');
  $stmt->execute(array($username));
  return $stmt->fetch()['id'];
}

function insertUser($username, $password,$email,$birth) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('INSERT INTO user (username,password,email,birth) VALUES(?, ?, ?, ?)');
  $stmt->execute(array($username, sha1($password), $email,$birth));
}


 ?>
