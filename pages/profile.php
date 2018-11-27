<?php
  include_once('../includes/session.php');
  include_once('../database/db_list.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_profile.php');

  if (isset($_SESSION['username'])){
    draw_header($_SESSION['username']);
  }else {
    header('Location: login.php');
  }

  $userInfo = listProfile($_SESSION['username']);

  draw_profile($userInfo);
  draw_footer();
?>
