<?php
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_auth.php');

    if (isset($_SESSION['username']))
      draw_header();
    else {
      draw_header(NULL);
    }
  draw_register();
  draw_footer();
?>
