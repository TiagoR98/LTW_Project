<?php
include_once('../includes/session.php');
include_once('../database/db_user.php');

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$birth = $_POST['birth'];

//verifica se dados vazios
if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['birth'])) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid register data!');
  header('Location: ../pages/register.php');
  die();
}
try {
  insertUser($username, $password, $email, $birth);
  $_SESSION['username'] = $username;
  header('Location: ../pages/profile.php');
} catch (PDOException $e) {
  echo($e);
  header('Location: ../pages/login.php?error=true');
  die();
}

 ?>
