<?php
  include_once('../includes/session.php');
  include_once('../database/db_list.php');
  include_once('../database/db_user.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_channel.php');

  // Verify if user is logged in
    if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));

    if (!isset($_GET['channelId']))
    die(header('Location: ../pages/mainpage.php'));


  $storiesByChannel = getStoriesByChannel($_GET['channelId']);
  $currentChannel = getChannel($_GET['channelId']);

  draw_header($currentChannel['name']); 
  draw_channel($storiesByChannel,$currentChannel);

  draw_footer();
?>
