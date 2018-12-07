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

$storyId = $_POST['storyId'];

$comments = getCommentsByStory($storyId,$order);


foreach($comments as $comment) {
  draw_comment($comment);
}
?>
