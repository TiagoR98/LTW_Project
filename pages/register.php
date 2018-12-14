<?php
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_auth.php');

  if (isset($_SESSION['username'])){
    header('Location:../pages/mainpage.php');
  }

  draw_header("Register new account");
  draw_register();
  draw_footer();
?>
