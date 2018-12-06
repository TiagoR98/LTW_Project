<?php
include_once('../includes/session.php');
include_once('../database/db_story.php');
include_once('../database/db_user.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
  die(header('Location: ../pages/login.php'));

$content = $_POST['content'];
$author = getIdFromUsername($_SESSION['username']);
$date = date("Y-m-d H:i:s");
$story = $_REQUEST['storyId'];


//csrf
if ($_SESSION['csrf'] !== $_POST['csrf']) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Non-Legitimate Request');
  header('Location: ../pages/story.php?storyId='.$story);
  die();
}

try {
  addComment($content,$date,$story,$author);
  $_SESSION['messages'][] = array('type' => 'success', 'content' => 'New comment posted Successfully');
  header('Location: ../pages/story.php?storyId='.$story);
} catch (PDOException $e) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error in posting comment!'.$e);
  header('Location: ../pages/new_comment.php?storyId=$story');
  die();
}

 ?>
