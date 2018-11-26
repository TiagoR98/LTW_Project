<?php
include_once('../includes/session.php');
include_once('../database/db_user.php');

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

try {
  insertUser($username, $password, $email);
  $_SESSION['username'] = $username;
  header('Location: ../pages/login.php');
} catch (PDOException $e) {
  echo($e);
  header('Location: ../pages/login.php?error=true');
}

 ?>
