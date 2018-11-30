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

//veirifica username
if(checkUsernameExists($username)){
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username Already Taken!');
  header('Location: ../pages/register.php');
  die();
}

try {
  insertUser($username, $password, $email, $birth);
  $_SESSION['username'] = $username;
  $_SESSION['messages'][] = array('type' => 'success', 'content' => 'New account created Successfully');
  header('Location: ../pages/profile.php');
} catch (PDOException $e) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error in creating user!'.$e);
  header('Location: ../pages/login.php');
  die();
}

 ?>
