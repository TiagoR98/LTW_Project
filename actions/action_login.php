<?php
include_once('../includes/session.php');
include_once('../database/db_user.php');

$username = $_POST['username'];
$password = $_POST['password'];

if(checkUserPassword($username,$password)){
  $_SESSION['username'] = $username;
  $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Login Successfully!');
  header('Location:../pages/profile.php');
}else{
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Wrong Username or Pasword');
  header('Location:../pages/login.php?wrong_pass=true');
}

 ?>
