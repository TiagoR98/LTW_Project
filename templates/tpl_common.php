<?php function draw_header(){
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>channelOmania</title>
    <meta charset="UTF-8">
    <link href="../css/style.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <h1><a href="mainpage.php">channelOmania</a></h1>
      <?php if(isset($_SESSION['username'])){ ?>
        <h2>Bem-Vindo <?php echo($_SESSION['username']) ?> </h2>
        <h2><a href="../actions/action_logout.php">Logout</a></h2>
        <h2><a href="../pages/profile.php">Profile info</a></h2>
      <?php } ?>
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
