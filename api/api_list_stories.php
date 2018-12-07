<?php
include_once('../includes/session.php');
include_once('../database/db_list.php');
include_once('../database/db_story.php');
include_once('../templates/tpl_common.php');
include_once('../templates/tpl_mainpage.php');

if(isset($_POST['order']))
  $order = $_POST['order'];
else
  $order = '';

  if(isset($_POST['userStories']) && ($_POST['userStories'] !== "false")){
    $storyInfo = getStoriesByUser(getUsernameFromId($_POST['userStories']),$order);
  }else if(isset($_POST['channelStories']) && ($_POST['channelStories'] !== "false")){
    $storyInfo = getStoriesByChannel($_POST['channelStories'],$order);
  }else{
    $storyInfo = listStory($order);
  }

foreach($storyInfo as $story) {
  draw_story_list_item($story);
}
?>
