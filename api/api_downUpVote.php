<?php
include_once('../includes/session.php');
include_once('../database/db_story.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
  die(header('Location: ../pages/login.php'));

$storyId = $_POST['storyId'];
$voteType = $_POST['voteType'];

try {
  addStoryVote($storyId,$_SESSION['username'],$voteType);
  $result =array('downvotes' => getStory($storyId)['downvotes'], 'upvotes' => getStory($storyId)['upvotes']);
} catch (PDOException $e) {
  echo($e);
}

echo json_encode($result);
?>
