<?php
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_auth.php');


  if (isset($_SESSION['username'])){
    draw_header($_SESSION['username']);
  }else {
    draw_header(NULL);
  }


  draw_login();
  draw_footer();
?>
