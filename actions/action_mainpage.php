<?php
  include_once('../includes/session.php');

  // Verify if user is logged in
    if (!isset($_SESSION['username']))
    die(header('Location: ../pages/login.php'));


  if (isset($_SESSION['username'])){
    header('Location:../pages/mainpage.php');
  }else {
    header('Location:../pages/login.php');
  }

?>
