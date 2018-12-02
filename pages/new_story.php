<?php
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_story.php');

  draw_header($_SESSION['username']);

  draw_new_story();

  draw_footer();
?>
