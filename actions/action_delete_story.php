<?php
include_once('../includes/session.php');
include_once('../database/db_story.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));

$storyInfo = getStory($_GET['storyId']);

if((getIdFromUsername($_SESSION['username']) !== $storyInfo['storyAuthor']) || ($_GET['csrf'] !== $_SESSION['csrf'])){
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid Request');
  header('Location:../pages/mainpage.php');
  die();
}

try{
  deleteStory($_GET['storyId']);
}catch(Exception $e){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error deleting story');
    header('Location:../pages/mainpage.php');
    die();
}

$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Story deleted successfully');
header('Location:../pages/mainpage.php');

 ?>
