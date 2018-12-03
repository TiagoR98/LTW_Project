<?php
include_once('../includes/session.php');
include_once('../database/db_list.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
  die(header('Location: ../pages/login.php'));


$userInfo = listProfile($_SESSION['username']);


if(($_FILES['profilePic']['error']==0)){

  $extension =  findexts($_FILES["profilePic"]["name"]);

  $oldPic = $userInfo['profilePic'];
  $userInfo['profilePic']=uniqid().$extension;
  $target_dir = "../files/profilePics/";
  $target_file = $target_dir .  $userInfo['profilePic'];

  //verificar se e uma imagem
  $check = getimagesize($_FILES["profilePic"]["tmp_name"]);
  $max_image_size = 1000;

  if($check !== false && $check[1]<=$max_image_size && $check[2]<=$max_image_size) {
    try{
      unlink($target_dir.$oldPic); //elimina a imagem antiga
      move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_file);
      chmod($target_file, 0666); //permissao de escrita
    }catch(Exception $e){
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error uploading Image');
        header('Location:../pages/profile.php');
        die();
    }
  }else{
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Image larger than '.$max_image_size.'X'.$max_image_size.'px');
    header('Location:../pages/profile.php');
    die();
  }

}else if(isset($_POST['email']) && !empty($_POST['email'])){
  $userInfo['email'] = $_POST['email'];
}else if(isset($_POST['birth']) && !empty($_POST['birth'])){
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

function findexts ($filename)
{
$filename = strtolower($filename) ;
$exts = explode(".", $filename) ;
$n = count($exts)-1;
$exts = $exts[$n];
return ".".$exts;
}


$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Profile info updated successfully');
header('Location:../pages/profile.php');

 ?>
