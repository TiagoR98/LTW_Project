<?php
  include_once('../includes/session.php');
  include_once('../database/db_story.php');
  include_once('../database/db_list.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_story.php');

  // Verify if user is logged in
    if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));


  $story = getStory($_GET['storyId']);
  draw_header($story['title']);
  draw_story($story);

  $storyID = $story['storyID'];
  $comments = getCommentsByStory($storyID);

  draw_comments($comments);

  draw_footer();
?>
