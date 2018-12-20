<?php
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_story.php');

  // Verify if user is logged in
    if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));

    $channel = (!isset($_GET['channelId']))?0:$_GET['channelId'];

  draw_header("Write your story");
  draw_new_story($channel);

  draw_footer();
?>
