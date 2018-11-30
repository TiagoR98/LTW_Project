<?php
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_auth.php');


  if (isset($_SESSION['username'])){
    draw_header(); //redirecionar para pagina inicial
  }else {
    draw_header();
  }
  draw_login();
  draw_footer();
?>
