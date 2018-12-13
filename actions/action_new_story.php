<?php
include_once('../includes/session.php');
include_once('../database/db_story.php');
include_once('../database/db_user.php');
include_once('../actions/findexts.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
  die(header('Location: ../pages/login.php'));

//verifica se dados vazios
if(empty($_POST['title']) || empty($_POST['story_input'])) {
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

    $extension =  findexts($_FILES["storyImage"]["name"]);

    $storyImage=uniqid().$extension;
    $target_dir = "../files/storyImages/";
    $target_file = $target_dir .  $storyImage;

    //verificar se e uma imagem
    $check = getimagesize($_FILES["storyImage"]["tmp_name"]);

    move_uploaded_file($_FILES["storyImage"]["tmp_name"], $target_file);
    chmod($target_file, 0666);

    // Crete an image representation of the original image
    $original = imagecreatefromstring(file_get_contents($target_file));

    $width = imagesx($original);     // width of the original image
    $height = imagesy($original);    // height of the original image

    // Calculate width and height of medium sized image (max width: 500)
    $mediumwidth = $width;
    $mediumheight = $height;
    $maxSize = max($width,$height);

    if ($maxSize > 500) {
      if ($mediumwidth == $maxSize) {
        $mediumwidth = 500;
        $mediumheight = $mediumheight * ( $mediumwidth / $width );
      }
      else if ($mediumheight == $maxSize) {
        $mediumheight = 500;
        $mediumwidth = $mediumwidth * ( $mediumheight / $height );
      }
    }

    // Create and save a medium image
    $medium = imagecreatetruecolor($mediumwidth, $mediumheight);
    imagecopyresized($medium, $original, 0, 0, 0, 0, $mediumwidth, $mediumheight, $width, $height);
    imagejpeg($medium, $target_file);

    try{
      move_uploaded_file($_FILES["storyImage"]["tmp_name"], $target_file);
      chmod($target_file, 0666); //permissao de escrita
    }catch(Exception $e){
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error uploading Image');
        header('Location:../pages/new_story.php');
        die();
    }

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
