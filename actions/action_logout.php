<?php
include_once('../includes/session.php');
include_once('../database/db_user.php');

  session_destroy();
  header("Location:../pages/login.php");
 ?>
