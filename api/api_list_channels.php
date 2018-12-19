<?php
include_once('../includes/session.php');
include_once('../database/db_list.php');
include_once('../database/db_story.php');
include_once('../templates/tpl_common.php');
include_once('../templates/tpl_mainpage.php');
include_once('../templates/tpl_all_channels.php');

if(isset($_POST['order']))
  $order = $_POST['order'];
else
  $order = '';

$channels = listChannel($order);

draw_channel_user($channels);

?>
