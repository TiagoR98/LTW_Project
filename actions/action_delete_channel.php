<?php
include_once('../includes/session.php');
include_once('../database/db_list.php');
include_once('../database/db_user.php');
include_once('../database/db_channel.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));

    $channels = listChannel();

    $channel = $channels[$_GET['channelId']-1];

if((getIdFromUsername($_SESSION['username']) !== $channel['author']) || ($_GET['csrf'] !== $_SESSION['csrf'])){
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid Request');
  header('Location:../pages/mainpage.php');
  die();
}

try{
  deleteChannel($_GET['channelId']);
}catch(Exception $e){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error deleting channel');
    header('Location:../pages/mainpage.php');
    die();
}

$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Channel deleted successfully');
header('Location:../pages/mainpage.php');

 ?>
