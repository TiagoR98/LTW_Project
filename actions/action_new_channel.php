<?php
include_once('../includes/session.php');
include_once('../includes/imageCrop.php');
include_once('../database/db_channel.php');
include_once('../database/db_user.php');
include_once('../actions/findexts.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
  die(header('Location: ../pages/login.php'));

//verifica se dados vazios
if(empty($_POST['name'])) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Name of channel cannot be empty!');
  header('Location: ../pages/new_channel.php');
  die();
}

//verifica caracteres especiais channel name
if ( !preg_match ("/^[a-zA-Z\s0-9]+$/", $_POST['name'])) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Channel Name can only contain letters,numbers and spaces');
  header('Location: ../pages/new_channel.php');
  die();
}

$name = $_POST['name'];
$author = getIdFromUsername($_SESSION['username']);

$coverImage = cropCoverImage();


//csrf
if ($_SESSION['csrf'] !== $_POST['csrf']) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Non-Legitimate Request');
  header('Location: ../pages/mainpage.php');
  die();
}

try {
  addChannel($name,$coverImage,$author);
  $_SESSION['messages'][] = array('type' => 'success', 'content' => 'New channel created Successfully');
  header('Location: ../pages/mainpage.php');
} catch (PDOException $e) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error in creating channel!'.$e);
  header('Location: ../pages/new_channel.php');
  die();
}
?>
