<?php
include_once('../includes/session.php');
include_once('../database/db_story.php');
include_once('../database/db_user.php');

$title = $_POST['title'];
$content = $_POST['story_input'];
$author = getIdFromUsername($_SESSION['username']);
$date = date("Y-m-d");
$channel = 1; //temporary

try {
  addStory($title,$content,$author,$date,$channel);
  $_SESSION['messages'][] = array('type' => 'success', 'content' => 'New story posted Successfully');
  header('Location: ../pages/mainpage.php');
} catch (PDOException $e) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error in posting story!'.$e);
  header('Location: ../pages/new_story.php');
  die();
}

 ?>
