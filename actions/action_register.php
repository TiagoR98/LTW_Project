<?php
include_once('../includes/session.php');
include_once('../database/db_user.php');

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$birth = $_POST['birth'];

$minPassLength = 6;
$maxPassLength = 60;

//verifica se dados vazios
if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['birth'])) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid register data!');
  header('Location: ../pages/register.php');
  die();
}

//verifica caracteres especiais username
if ( !preg_match ("/^[a-zA-Z\s0-9]+$/", $_POST['username'])) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username can only contain letters,numbers and spaces');
  header('Location: ../pages/register.php');
  die();
}

//verifica caracteres especiais email
if ( !preg_match ("/^[a-zA-Z0-9@.]+$/", $_POST['email'])) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Email contain invalid characters');
  header('Location: ../pages/register.php');
  die();
}

//veirifica username
if(checkUsernameExists($username)){
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username Already Taken!');
  header('Location: ../pages/register.php');
  die();
}

//veirifica tamanho password
if(strlen($password) < $minPassLength || strlen($password) > $maxPassLength){
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Password size error');
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
