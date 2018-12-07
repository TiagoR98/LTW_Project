<?php
include_once('../includes/session.php');
include_once('../database/db_list.php');
include_once('../templates/tpl_common.php');
include_once('../templates/tpl_mainpage.php');

if(isset($_POST['order']))
  $order = $_POST['order'];
else
  $order = '';

$storyInfo = listStory($order);

foreach($storyInfo as $story) {
  draw_story_list_item($story);
}
?>
