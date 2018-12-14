<?php include_once('../templates/tpl_mainpage.php'); ?>

<?php function draw_channel($channel) { ?>

  <div id="list_channels">
    <p><a href = "../pages/new_channel.php" >Create a channel</a></p>
    <?php $channels = listChannel(); ?>
    <ul>
    <?php foreach($channels as $channel_list) { ?>
      <li><a href = "../pages/channel.php?channelId=<?php echo($channel_list['ID']); ?>" ><?php echo($channel_list['name']); ?></a></li>
    <?php } ?>
    </ul>
  </div>

  <div id="cover"><img id="cover_image" src="../files/croppedCover/<?php if($channels[$_GET['channelId']-1]['coverImage']!="") { echo($channels[$_GET['channelId']-1]['coverImage']); } else {?>default.png<?php } ?>"
    alt="<?php echo($channels[$_GET['channelId']-1]['name']); ?>'s cover image"></div>
  <h1><?php echo($channels[$_GET['channelId']-1]['name']); ?></h1>
  <?php if($channels[$_GET['channelId']-1]['author'] == getIdFromUsername($_SESSION['username'])) { ?>
    <a href="../actions/action_delete_channel.php?channelId=<?php echo($channels[$_GET['channelId']-1]['ID']); ?>&csrf=<?php echo($_SESSION['csrf']); ?>"> Delete Channel</a>
  <?php } ?>
  <section id="channelStories" data-id="<?php echo $channel[0]['channel'] ?>">
  <h2>All Stories</h2>
  <p><a href = "../pages/new_story.php?channelId=<?php echo($_GET['channelId']); ?>" >Add a story</a></p>

  <?php draw_story_list($channel); ?>
</section>
<?php } ?>

<?php function draw_new_channel() { ?>
  <section id="new_channel">
    <h2>Create your channel</h2>
    <form action="../actions/action_new_channel.php" method="post" enctype="multipart/form-data">
      <input type="text" name="name" required placeholder="Name">
      <label>Cover image: <input type="file" name="coverImage" accept="image/*"></label>
      <input id="browser-width" type="hidden" name="browser-width" value="">
      <input type="submit" value="Create">
    </form>
  </section>
  <script>
  document.getElementById('browser-width').value = screen.width;
  </script>
<?php } ?>
