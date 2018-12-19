<?php
  include_once('../includes/session.php');
  include_once('../database/db_list.php');
  include_once('../database/db_user.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_all_channels.php');

  if (isset($_SESSION['username'])){
    draw_header("All Channels");
  }else {
    header('Location: login.php');
    die();
  }

  $channels = listChannel();
  draw_channel_list($channels);

  draw_footer();
?>
