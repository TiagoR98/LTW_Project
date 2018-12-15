<?php function draw_header($tabText = ""){
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title><?php if($tabText != ""){echo($tabText." - ");}  ?>channelOmania</title>
    <meta charset="UTF-8">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/input.css" rel="stylesheet">
    <link href="../css/links.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="shortcut icon" href="../files/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="../files/favicon.ico" type="image/x-icon" />
  </head>
  <body>
    <header id="header">
      <?php if(isset($_SESSION['username'])){ ?>

        <div id='options'>
          <a href="../pages/profile.php"><i class="fas fa-user"></i> <?php echo($_SESSION['username']) ?></a>
          <a href="../pages/profile.php"><i class="fas fa-align-justify"></i> Profile info</a>
          <a href="../actions/action_logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      <?php } ?>
      <h1><a href="mainpage.php"><i class="fas fa-dice-d20"></i> channelOmania</a></h1>

    </header>

    <?php if(isset($_SESSION['username'])){ ?>
    <div id="list_channels">
      <p><a href = "../pages/new_channel.php" ><i class="fas fa-pencil-alt"></i> Create a channel</a></p>
      <?php $channels = listChannel('mActive'); ?>
      <ul>
      <?php if(count($channels) > 5) { ?>
        <?php for ($i=0; $i < 5; $i++) { ?>
          <li><a href = "../pages/channel.php?channelId=<?php echo($channels[$i]['ID']); ?>" ><?php echo($channels[$i]['name']); ?></a></li>
        <?php } ?>
          <li id="moreChannels"><a href = "../pages/all_channels.php" >More Channels</a></li>
      <?php } else { ?>
        <?php foreach($channels as $channel_list){ ?>
          <li><a href = "../pages/channel.php?channelId=<?php echo($channel_list['ID']); ?>" ><?php echo($channel_list['name']); ?></a></li>
        <?php } ?>
      <?php } ?>
      </ul>
    </div>
    <?php } ?>

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

  <footer class="footer">
    <p>	&#9400;2018 - Tiago e Pati Studio (Todos os direitos Reservados) ,</p>
  </footer>
</body>
</html>

<?php }
 ?>
