<?php include_once('../templates/tpl_mainpage.php'); ?>
<?php include_once('../database/db_channel.php'); ?>

<?php function draw_channel($storiesByChannel,$currentChannel) { ?>

  <?php $channels = listChannel(); ?>

  <?php if($currentChannel['author'] == getIdFromUsername($_SESSION['username'])) { ?>
  <script src="../js/editChannel.js"></script>
  <form action="../actions/action_edit_channel.php?channelId=<?php echo($currentChannel['ID']); ?>" method="post" enctype="multipart/form-data">
  <?php } ?>

  <div id="cover"><img id="cover_image" src="../files/croppedCover/<?php if($currentChannel['coverImage']!="") { echo($currentChannel['coverImage']); } else {?>default.png<?php } ?>"
    alt="<?php echo($currentChannel['name']); ?>'s cover image"></div>
  <h1 id="channelName"><?php echo($currentChannel['name']); ?>

  <?php if($currentChannel['author'] == getIdFromUsername($_SESSION['username'])) { ?>
  <button text='Edit' onclick="edit('name')">Edit</button>
  <?php } ?></h1><br>

  <?php if($currentChannel['author'] == getIdFromUsername($_SESSION['username'])) { ?>
    <a href="../actions/action_delete_channel.php?channelId=<?php echo($currentChannel['ID']); ?>&csrf=<?php echo($_SESSION['csrf']); ?>"> Delete Channel</a>
  <?php } ?>

  <?php if($currentChannel['author'] == getIdFromUsername($_SESSION['username'])) { ?>
  <h3>Upload new cover image: </h3>
    <h3>
        <input type="file" name="coverImage" id="coverImg" accept="image/*">
        <input type="submit">
    </h3>
  <?php } ?>


  <?php if($channels[$_GET['channelId']-1]['author'] == getIdFromUsername($_SESSION['username'])) { ?>
 <input id="browser-width" type="hidden" name="browser-width" value="">
  <input type="hidden" name="csrf" value="<?php echo($_SESSION['csrf']);?>">
  </form>
  <script>
  document.getElementById('browser-width').value = screen.width;
  </script>
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
