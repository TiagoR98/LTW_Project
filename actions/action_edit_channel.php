<?php
include_once('../includes/session.php');
include_once('../database/db_list.php');
include_once('../actions/findexts.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
  die(header('Location: ../pages/login.php'));


$userInfo = listProfile($_SESSION['username']);

$channels = listChannel();

if(isset($_POST['coverImg']) && !empty($_POST['coverImg'])){
$channelInfo['coverImg'] = cropCoverImage();
}

if(isset($_POST['name']) && !empty($_POST['name'])){
   //verifica caracteres especiais channel name
   if ( !preg_match ("/^[a-zA-Z\s0-9]+$/", $_POST['name'])) {
     $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Channel Name can only contain letters,numbers and spaces');
     header('Location: ../pages/channel.php');
     die();
   }

  $channelInfo['name'] = $_POST['name'];
}

if(count($channelInfo) == 0){
$_SESSION['messages'][] = array('type' => 'error', 'content' => 'No data to update!');
  header('Location:../pages/channel.php');
  die();
}

try{
  updateChannel($channelInfo);
}catch(Exception $e){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error updating channel info');
    header('Location:../pages/channel.php');
    die();
}


$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Profile info updated successfully');
header('Location:../pages/profile.php');

 ?>
