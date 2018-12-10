<?php
include_once('../includes/session.php');
include_once('../database/db_channel.php');
include_once('../database/db_user.php');
include_once('../actions/findexts.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
  die(header('Location: ../pages/login.php'));

$name = $_POST['name'];
$author = getIdFromUsername($_SESSION['username']);

if(($_FILES['coverImage']['error']==0)){

  $coverImage = $_FILES["coverImage"]["name"];
  $extension =  findexts($_FILES["coverImage"]["name"]);

  $oldPic = $coverImage;
  $coverImage=uniqid().$extension;
  $target_dir = "../files/coverImages/";
  $target_file = $target_dir .  $coverImage;

  //verificar se e uma imagem
  $check = getimagesize($_FILES["coverImage"]["tmp_name"]);
  //$max_image_size = 1000;

//  if($check !== false && $check[1]<=$max_image_size && $check[2]<=$max_image_size) {
    try{
      unlink($target_dir.$oldPic); //elimina a imagem antiga
      move_uploaded_file($_FILES["coverImage"]["tmp_name"], $target_file);
      chmod($target_file, 0666); //permissao de escrita
    }catch(Exception $e){
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error uploading Image');
        header('Location:../pages/new_channel.php');
        die();
    }
/*  }else{
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Image larger than '.$max_image_size.'X'.$max_image_size.'px');
    header('Location:../pages/new_channel.php');
    die();
  }*/

}

try {
  addChannel($name,$coverImage,$author);
  $_SESSION['messages'][] = array('type' => 'success', 'content' => 'New channel created Successfully');
  header('Location: ../pages/mainpage.php');
} catch (PDOException $e) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error in creating channel!'.$e);
  header('Location: ../pages/new_channel.php');
  die();
}
?>
