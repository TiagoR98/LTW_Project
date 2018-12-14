<?php
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_story.php');
  include_once('../database/db_story.php');
  include_once('../database/db_list.php');

  // Verify if user is logged in
    if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));


  $story = getStory($_GET['storyId']);
  draw_header("Write new comment");
  draw_story($story);

  draw_new_comment($story);

  $storyID = $story['storyID'];
  $comments = getCommentsByStory($storyID);

  draw_comments($comments);

  draw_footer();
?>
