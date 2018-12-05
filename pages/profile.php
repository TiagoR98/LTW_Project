<?php
  include_once('../includes/session.php');
  include_once('../database/db_list.php');
  include_once('../database/db_user.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_profile.php');
  include_once('../templates/tpl_mainpage.php');

  if (isset($_SESSION['username'])){
    draw_header();
  }else {
    header('Location: login.php');
    die();
  }

  if(isset($_GET['userId']))
    $userInfo = listProfile(getUsernameFromId($_GET['userId']));
  else
    $userInfo = listProfile($_SESSION['username']);

  $userInfo['stories']=getStoriesByUser($userInfo['username']);

  draw_profile($userInfo);
  draw_user_stories($userInfo['stories']);
  draw_footer();
?>
