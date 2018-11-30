<?php
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_mainpage.php');

  draw_header($_SESSION['username']);

  draw_mainpage();

  draw_footer();
?>
