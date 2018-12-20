<?php
include_once('../includes/session.php');
include_once('../database/db_list.php');
include_once('../actions/findexts.php');
include_once('../database/db_user.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
  die(header('Location: ../pages/login.php'));


$userInfo = listProfile($_SESSION['username']);


if($_POST['csrf'] !== $_SESSION['csrf']){
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid Request');
  die();
  header('Location: ../pages/channel.php?profile.php?userId='.getIdFromUsername($_SESSION['username']));
  die();
}

if(($_FILES['profilePic']['error']==0)){

  $extension =  findexts($_FILES["profilePic"]["name"]);

  $oldPic = $userInfo['profilePic'];
  $userInfo['profilePic']=uniqid().$extension;
  $target_dir = "../files/profilePics/";
  $target_file = $target_dir .  $userInfo['profilePic'];

  //verificar se e uma imagem
  $check = getimagesize($_FILES["profilePic"]["tmp_name"]);

  $smallFileName = "../files/croppedProfile/" . $userInfo['profilePic'];
  unlink($target_dir.$oldPic); //elimina a imagem antiga
  move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_file);
  chmod($target_file, 0666);

  // Crete an image representation of the original image
  $original = imagecreatefromstring(file_get_contents($target_file));

  $width = imagesx($original);     // width of the original image
  $height = imagesy($original);    // height of the original image
  $square = min($width, $height);  // size length of the maximum square

  // Create and save a small square thumbnail
  $small = imagecreatetruecolor(300, 300);
  $white = imagecolorallocate($small, 255, 255, 255);
  imagefill($small, 0, 0, $white);
  imagecopyresampled($small, $original, 0, 0, ($width>$square)?($width-$square)/2:0, ($height>$square)?($height-$square)/2:0, 300, 300, $square, $square);
  imagejpeg($small, $smallFileName);

  try{
    unlink("../files/croppedProfile/".$oldPic); //elimina a imagem antiga
    move_uploaded_file($_FILES["profilePic"]["tmp_name"], $smallFileName);
    chmod($smallFileName, 0666);
  }catch(Exception $e){
      $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error uploading Image');
      header('Location:../pages/profile.php');
      die();
  }

}else if(isset($_POST['email']) && !empty($_POST['email'])){
  //verifica caracteres especiais email
  if ( !preg_match ("/^[a-zA-Z0-9@.]+$/", $_POST['email'])) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Email contains invalid characters');
    header('Location: ../pages/profile.php');
    die();
  }
  $userInfo['email'] = $_POST['email'];
}else if(isset($_POST['birth']) && !empty($_POST['birth'])){
  //verifica caracteres especiais data
  if ( !preg_match ("/^[0-9-]+$/", $_POST['birth'])) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Birthdate contains invalid characters');
    header('Location: ../pages/profile.php');
    die();
  }
  $userInfo['birth'] = $_POST['birth'];
}else{
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'No data to update!');
  header('Location:../pages/profile.php');
  die();
}

try{
  updateProfile($userInfo);
}catch(Exception $e){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error updating profile info');
    header('Location:../pages/profile.php');
    die();
}


$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Profile info updated successfully');
header('Location:../pages/profile.php');

 ?>
