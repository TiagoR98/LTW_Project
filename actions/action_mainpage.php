<?php
  include_once('../includes/session.php');

  if (isset($_SESSION['username'])){
    header('Location:../pages/mainpage.php');
  }else {
    header('Location:../pages/login.php');
  }

?>
