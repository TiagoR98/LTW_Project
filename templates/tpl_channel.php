<?php include_once('../templates/tpl_mainpage.php'); ?>
<?php include_once('../database/db_channel.php'); ?>

<?php function draw_channel($storiesByChannel) { ?>

  <div id="list_channels">
    <p><a href = "../pages/new_channel.php" >Create a channel</a></p>
    <?php $channels = listChannel(); ?>
    <ul>
    <?php foreach($channels as $channel_list) { ?>
      <li><a href = "../pages/channel.php?channelId=<?php echo($channel_list['ID']); ?>" ><?php echo($channel_list['name']); ?></a></li>
    <?php } ?>
    </ul>
  </div>

  <?php $currentChannel = getChannel($_GET['channelId']); ?>
  <div id="cover"><img id="cover_image" src="../files/croppedCover/<?php if($currentChannel['coverImage']!="") { echo($currentChannel['coverImage']); } else {?>default.png<?php } ?>"
    alt="<?php echo($currentChannel['name']); ?>'s cover image"></div>
  <h1><?php echo($currentChannel['name']); ?></h1>
  <?php if($currentChannel['author'] == getIdFromUsername($_SESSION['username'])) { ?>
    <a href="../actions/action_delete_channel.php?channelId=<?php echo($currentChannel['ID']); ?>&csrf=<?php echo($_SESSION['csrf']); ?>"> Delete Channel</a>
  <?php } ?>
  <section id="channelStories" data-id="<?php echo $_GET['channelId'] ?>">
    <h2>All Stories</h2>
    <p><a href = "../pages/new_story.php?channelId=<?php echo($_GET['channelId']); ?>" >Add a story</a></p>

    <?php draw_story_list($storiesByChannel); ?>
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
