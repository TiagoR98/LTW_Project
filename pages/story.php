<?php
  include_once('../includes/session.php');
  include_once('../database/db_story.php');
  include_once('../database/db_list.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_story.php');

  draw_header($_SESSION['username']);

  $story = getStory($_GET['storyId']);
  draw_story($story);

  $storyID = $story['storyID'];
  $comments = getCommentsByStory($storyID);

  draw_comments($comments);

  draw_footer();
?>
