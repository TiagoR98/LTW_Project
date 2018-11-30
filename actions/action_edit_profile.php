<?php
include_once('../includes/session.php');
include_once('../database/db_list.php');


$userInfo = listProfile($_SESSION['username']);

if(isset($_FILES['profilePic'])){

  $extension =  findexts($_FILES["profilePic"]["name"]);

  $userInfo['profilePic']=uniqid().$extension;
  $target_dir = "../files/profilePics/";
  $target_file = $target_dir .  $userInfo['profilePic'];

  //verificar se e uma imagem
  $check = getimagesize($_FILES["profilePic"]["tmp_name"]);
  $max_image_size = 1000;

  if($check !== false && $check[1]<=$max_image_size && $check[2]<=$max_image_size) {
    try{
      move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_file);
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


}

try{
  updateProfile($userInfo);
}catch(Exception $e){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error uploading Image');
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

$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Image Uploaded Successfully');
header('Location:../pages/profile.php');

 ?>
