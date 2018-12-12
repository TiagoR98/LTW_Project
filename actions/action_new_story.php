<?php
include_once('../includes/session.php');
include_once('../database/db_story.php');
include_once('../database/db_user.php');
include_once('../actions/findexts.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
  die(header('Location: ../pages/login.php'));

//verifica se dados vazios
if(empty($_POST['title']) || empty($_POST[̈́'story_input'])) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Title and story cannot be empty!');
  header('Location: ../pages/new_story.php');
  die();
}

$title = $_POST['title'];
$content = $_POST['story_input'];
$author = getIdFromUsername($_SESSION['username']);
$date = date("Y-m-d H:i:s");
$channel = $_POST['channel'];

if(isset($_FILES['storyImage']['name'])){
  if(($_FILES['storyImage']['error']==0)){

    $storyImage = $_FILES["storyImage"]["name"];
    $extension =  findexts($_FILES["storyImage"]["name"]);

    $storyImage=uniqid().$extension;
    $target_dir = "../files/storyImages/";
    $target_file = $target_dir .  $storyImage;

    //verificar se e uma imagem
    $check = getimagesize($_FILES["storyImage"]["tmp_name"]);
    //$max_image_size = 1000;

  //  if($check !== false && $check[1]<=$max_image_size && $check[2]<=$max_image_size) {
      try{
        move_uploaded_file($_FILES["storyImage"]["tmp_name"], $target_file);
        chmod($target_file, 0666); //permissao de escrita
      }catch(Exception $e){
          $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error uploading Image');
          header('Location:../pages/new_story.php');
          die();
      }
  /*  }else{
      $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Image larger than '.$max_image_size.'X'.$max_image_size.'px');
      header('Location:../pages/new_channel.php');
      die();
    }*/

  }
} else {
  $storyImage = NULL;
}

try {
  addStory($title,$content,$author,$date,$channel,$storyImage);
  $_SESSION['messages'][] = array('type' => 'success', 'content' => 'New story posted Successfully');
  header('Location: ../pages/channel.php?channelId='.$channel);
} catch (PDOException $e) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error in posting story!'.$e);
  header('Location: ../pages/new_story.php');
  die();
}

 ?>
