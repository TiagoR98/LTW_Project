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

if(isset($_POST['userStories']) && ($_POST['userStories'] !== "false")){
  $result = getStoriesByUser(getUsernameFromId($_POST['userStories']),$order,$offset,$limit);
}else if(isset($_POST['channelStories']) && ($_POST['channelStories'] !== "false")){
  $result = getStoriesByChannel($_POST['channelStories'],$order,$offset,$limit);
}else{
  $result = listStory($order,$offset,$limit);
}

} catch (PDOException $e) {
  echo($e);
}

foreach ($result as $index => $story) {
draw_story_list_item($story);
}

?>
