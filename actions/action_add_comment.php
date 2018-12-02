<?php
include_once('../includes/session.php');
include_once('../database/db_story.php');
include_once('../database/db_user.php');

$content = $_POST['content'];
$author = getIdFromUsername($_SESSION['username']);
$date = date("Y-m-d");
$story = $_REQUEST['storyId'];

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
