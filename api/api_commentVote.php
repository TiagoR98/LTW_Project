<?php
include_once('../includes/session.php');
include_once('../database/db_story.php');
include_once('../database/db_list.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
  die(header('Location: ../pages/login.php'));

$commentId = $_POST['commentId'];
$voteType = $_POST['voteType'];

try {
  addCommentVote($commentId,$_SESSION['username'],$voteType);
  $result =array('downvotes' => getComment($commentId)['downvotes'], 'upvotes' => getComment($commentId)['upvotes']);
} catch (PDOException $e) {
  echo($e);
}

echo json_encode($result);
?>
