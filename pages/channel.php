<?php
  include_once('../includes/session.php');
  include_once('../database/db_list.php');
  include_once('../database/db_user.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_channel.php');

  // Verify if user is logged in
    if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));


  draw_header(); //alterar header

  $storiesByChannel = getStoriesByChannel($_GET['channelId']);

  draw_channel($storiesByChannel);

  draw_footer();
?>
