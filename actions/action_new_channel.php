<?php
include_once('../includes/session.php');
include_once('../database/db_channel.php');
include_once('../database/db_user.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
  die(header('Location: ../pages/login.php'));

$name = $_POST['name'];
$author = getIdFromUsername($_SESSION['username']);

try {
  addChannel($name,$author);
  $_SESSION['messages'][] = array('type' => 'success', 'content' => 'New channel created Successfully');
  header('Location: ../pages/mainpage.php');
} catch (PDOException $e) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error in creating channel!'.$e);
  header('Location: ../pages/new_channel.php');
  die();
}

 ?>
