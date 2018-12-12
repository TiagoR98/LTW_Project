<?php
include_once('../includes/session.php');
include_once('../database/db_story.php');
include_once('../database/db_user.php');
include_once('../actions/findexts.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
  die(header('Location: ../pages/login.php'));

$content = $_POST['content'];
$author = getIdFromUsername($_SESSION['username']);
$date = date("Y-m-d H:i:s");
$story = $_REQUEST['storyId'];

//verifica se dados vazios
if(empty($_POST['content'])) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Comment cannot be empty!');
  header('Location: ../pages/new_comment.php?storyId='.$story);
  die();
}

if(isset($_FILES['commentImage']['name'])){
  if(($_FILES['commentImage']['error']==0)){

    $commentImage = $_FILES["commentImage"]["name"];
    $extension =  findexts($_FILES["commentImage"]["name"]);

    $commentImage=uniqid().$extension;
    $target_dir = "../files/commentImages/";
    $target_file = $target_dir .  $commentImage;

    //verificar se e uma imagem
    $check = getimagesize($_FILES["commentImage"]["tmp_name"]);
    //$max_image_size = 1000;

  //  if($check !== false && $check[1]<=$max_image_size && $check[2]<=$max_image_size) {
      try{
        move_uploaded_file($_FILES["commentImage"]["tmp_name"], $target_file);
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
} else {
  $commentImage = NULL;
}


//csrf
if ($_SESSION['csrf'] !== $_POST['csrf']) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Non-Legitimate Request');
  header('Location: ../pages/story.php?storyId='.$story);
  die();
}

try {
  addComment($content,$date,$story,$author,$commentImage);
  $_SESSION['messages'][] = array('type' => 'success', 'content' => 'New comment posted Successfully');
  header('Location: ../pages/story.php?storyId='.$story);
} catch (PDOException $e) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error in posting comment!'.$e);
  header('Location: ../pages/new_comment.php?storyId=$story');
  die();
}

 ?>
