<?php
include_once('../includes/session.php');
include_once('../includes/imageCrop.php');
include_once('../database/db_list.php');
include_once('../database/db_channel.php');
include_once('../actions/findexts.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
  die(header('Location: ../pages/login.php'));

$userInfo = listProfile($_SESSION['username']);

if(isset($_GET['channelId'])){
  $currentChannel = getChannel($_GET['channelId']);
}else {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'No channel to edit');
  header('Location: ../pages/channel.php?channelId='.$_GET['channelId']);
  die();
}

if(getIdFromUsername($_SESSION['username']) != $currentChannel['author']){
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Not the author of the channel');
  header('Location: ../pages/channel.php?channelId='.$_GET['channelId']);
  die();
}

if(($_FILES['coverImage']['error']==0)){
$currentChannel['coverImage'] = cropCoverImage();
}

if(isset($_POST['name']) && !empty($_POST['name'])){
   //verifica caracteres especiais channel name
   if ( !preg_match ("/^[a-zA-Z\s0-9]+$/", $_POST['name'])) {
     $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Channel Name can only contain letters,numbers and spaces');
     header('Location: ../pages/channel.php?channelId='.$_GET['channelId']);
     die();
   }

  $currentChannel['name'] = $_POST['name'];
}

try{
  updateChannel($currentChannel);
}catch(Exception $e){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error updating channel info');
    header('Location: ../pages/channel.php?channelId='.$_GET['channelId']);
    die();
}


$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Channel info updated successfully');
header('Location: ../pages/channel.php?channelId='.$_GET['channelId']);

 ?>
