<?php
  include_once('../includes/session.php');
  include_once('../database/db_list.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_mainpage.php');

  draw_header($_SESSION['username']);

  $storyInfo = listStory();
  draw_mainpage($storyInfo);

  draw_footer();
?>