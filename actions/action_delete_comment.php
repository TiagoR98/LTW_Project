<?php
include_once('../includes/session.php');
include_once('../database/db_story.php');
include_once('../database/db_list.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));

$commentInfo = getComment($_GET['commentId']);

if((getIdFromUsername($_SESSION['username']) !== $commentInfo['author']) || ($_GET['csrf'] !== $_SESSION['csrf'])){
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid Request');
  header('Location:../pages/mainpage.php');
  die();
}

try{
  deleteComment($_GET['commentId']);
}catch(Exception $e){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error deleting comment');
    header('Location:../pages/mainpage.php');
    die();
}

$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Comment deleted successfully');
header('Location:../pages/story.php?storyId='.$commentInfo['story']);

 ?>
