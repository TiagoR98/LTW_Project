<?php
include_once('../includes/session.php');
include_once('../database/db_user.php');

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$birth = $_POST['birth'];

try {
  insertUser($username, $password, $email, $birth);
  $_SESSION['username'] = $username;
  header('Location: ../pages/profile.php');
} catch (PDOException $e) {
  echo($e);
  header('Location: ../pages/login.php?error=true');
}

 ?>
