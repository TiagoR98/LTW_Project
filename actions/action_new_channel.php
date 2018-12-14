<?php
include_once('../includes/session.php');
include_once('../database/db_channel.php');
include_once('../database/db_user.php');
include_once('../actions/findexts.php');

// Verify if user is logged in
  if (!isset($_SESSION['username']))
  die(header('Location: ../pages/login.php'));

//verifica se dados vazios
if(empty($_POST['name'])) {
  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Name of channel cannot be empty!');
  header('Location: ../pages/new_channel.php');
  die();
}

$name = $_POST['name'];
$author = getIdFromUsername($_SESSION['username']);

if(($_FILES['coverImage']['error']==0)){

  $extension =  findexts($_FILES["coverImage"]["name"]);

  $coverImage=uniqid().$extension;
  $target_dir = "../files/coverImages/";
  $target_file = $target_dir .  $coverImage;

  //verificar se e uma imagem
  $check = getimagesize($_FILES["coverImage"]["tmp_name"]);

  $newFileName = "../files/croppedCover/" . $coverImage;
  move_uploaded_file($_FILES["coverImage"]["tmp_name"], $target_file);
  chmod($target_file, 0666);

  // Crete an image representation of the original image
  $original = imagecreatefromstring(file_get_contents($target_file));

  $width = imagesx($original);     // width of the original image
  $height = imagesy($original);    // height of the original image

  // Calculate width and height
  $newwidth = $width;
  $newheight = $height;

  if ($newwidth < ($_POST['browser-width']-17)) {
    $newwidth = $_POST['browser-width']-17;
    $newheight = $newheight * ( $newwidth / $width );
  }

  // Create and save a medium image
  $new = imagecreatetruecolor($newwidth, $newheight);

  $white = imagecolorallocate($new, 255, 255, 255);
  imagefill($new, 0, 0, $white);

  imagecopyresized($new, $original, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
  imagejpeg($new, $newFileName);
  move_uploaded_file($_FILES["coverImage"]["tmp_name"], $newFileName);
  chmod($newFileName, 0666);

  $final = imagecreatetruecolor($_POST['browser-width']-17, 200);
  imagecopyresized($final, $new, 0, 0, 0, ($newheight>200)?($newheight-200)/2:0, $_POST['browser-width']-17, 200, $_POST['browser-width']-17, 200);
  imagejpeg($final, $newFileName);

  try{
    move_uploaded_file($_FILES["coverImage"]["tmp_name"], $newFileName);
    chmod($newFileName, 0666); //permissao de escrita
  }catch(Exception $e){
      $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Error uploading Image');
      header('Location:../pages/new_channel.php');
      die();
  }

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
