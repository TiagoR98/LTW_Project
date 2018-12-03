<?php
  include_once('../database/db_list.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_channel.php');

  draw_header(); //alterar header

  $channel = getStoriesByChannel($_GET['channelId']);

  draw_channel($channel);

  draw_footer();
?>
