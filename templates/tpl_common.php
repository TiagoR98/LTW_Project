<?php function draw_header($tabText = ""){
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title><?php if($tabText != ""){echo($tabText." - ");}  ?>channelOmania</title>
    <meta charset="UTF-8">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="shortcut icon" href="../files/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="../files/favicon.ico" type="image/x-icon" />
  </head>
  <body>
    <header class="header">
      <?php if(isset($_SESSION['username'])){ ?>

        <div id='options'>
          <a href="../pages/profile.php"><?php echo($_SESSION['username']) ?></a>
          <a href="../pages/profile.php">Profile info</a>
          <a href="../actions/action_logout.php">Logout</a>
        </div>
        <!--h2>Bem-Vindo <?php echo($_SESSION['username']) ?> </h2-->
      <?php } ?>
      <h1><a href="mainpage.php"><i class="fas fa-dice-d20"></i> channelOmania</a></h1>

    </header>

    <?php if (isset($_SESSION['messages'])) {?>
      <section id="messages">
        <?php foreach($_SESSION['messages'] as $message) { ?>
          <div class="<?=$message['type']?>"><?=$message['content']?></div>
        <?php } ?>
      </section>
    <?php unset($_SESSION['messages']); } ?>

<?php } ?>

<?php function draw_footer(){
  ?>

  <footer>
    <p>	&#9400;2018 - Tiago e Pati Studio (Todos os direitos Reservados) ,</p>
  </footer>
</body>
</html>

<?php }
 ?>
