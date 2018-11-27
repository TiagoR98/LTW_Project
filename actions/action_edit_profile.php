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
    if($check !== false) {
      move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_file);
    }


}

updateProfile($userInfo);

function findexts ($filename)
{
$filename = strtolower($filename) ;
$exts = explode(".", $filename) ;
$n = count($exts)-1;
$exts = $exts[$n];
return ".".$exts;
}


header('Location:../pages/profile.php');

 ?>
