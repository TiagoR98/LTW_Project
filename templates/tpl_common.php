<?php function draw_header($username){
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
      <h1><a href="register.php">channelOmania</a></h1>
      <?php if($username!=NULL){ ?>
        <h2>Bem-Vindo <?php echo($username) ?> </h2>
      <?php } ?>
    </header>
<?php } ?>

<?php function draw_footer(){
  ?>

  <footer>
    <p>	&#9400;2018 - Tiago e Pati Studio (Todos os direitos Reservados) ,</p>
  </footer>
</body>
</html>

<? }
 ?>
