<?php
include_once('../includes/session.php');
include_once('../database/db_story.php');
include_once('../database/db_list.php');
include_once('../templates/tpl_mainpage.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
  die(header('Location: ../pages/login.php'));

$order = $_POST['order'];
$offset = $_POST['offset'];
$limit = $_POST['limit'];

try {

  $storyId = $_POST['storyId'];

  $result = getCommentsByStory($storyId,$order,$offset,$limit);
} catch (PDOException $e) {
  echo($e);
}

foreach ($result as $index => $comment) {
draw_comment($comment);
}

?>
