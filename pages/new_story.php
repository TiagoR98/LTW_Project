<?php
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_story.php');

  // Verify if user is logged in
    if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));

    $story = (!isset($_GET['storyID']))?0:$_GET['storyId'];

  draw_header("Write your story");
  draw_new_story($_GET['channelId']);

  draw_footer();
?>
