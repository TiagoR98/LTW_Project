<?php include_once('../templates/tpl_mainpage.php'); ?>
<?php include_once('../database/db_channel.php'); ?>

<?php function draw_channel($storiesByChannel,$currentChannel) { ?>

  <?php $channels = listChannel('alphabetical'); ?>

  <?php if($currentChannel['author'] == getIdFromUsername($_SESSION['username'])) { ?>
  <script src="../js/editChannel.js"></script>
  <form action="../actions/action_edit_channel.php?channelId=<?php echo($currentChannel['ID']); ?>" method="post" enctype="multipart/form-data">
  <?php } ?>

  <div id="channel_div">
  <?php if($currentChannel['author'] == getIdFromUsername($_SESSION['username'])) { ?>
    <a href="../actions/action_delete_channel.php?channelId=<?php echo($currentChannel['ID']); ?>&csrf=<?php echo($_SESSION['csrf']); ?>"><i class="fas fa-trash-alt"></i> Delete Channel</a>
  <?php } ?>

  <?php if($currentChannel['author'] == getIdFromUsername($_SESSION['username'])) { ?>
  <h3>Upload new cover image: </h3>
    <h3>
        <input type="file" name="coverImage" id="coverImg" accept="image/*">
        <input type="submit">
    </h3>
  <?php } ?>
</div>

  <a href="../files/coverImages/<?php if($currentChannel['coverImage']!="") { echo($currentChannel['coverImage']); } else {?>default.png<?php } ?>" target="_blank">
    <div id="cover"><img id="cover_image" src="../files/croppedCover/<?php if($currentChannel['coverImage']!="") { echo($currentChannel['coverImage']); } else {?>default.png<?php } ?>"
    alt="<?php echo($currentChannel['name']); ?>'s cover image"></div></a>
  <h1 id="channelName"><?php echo($currentChannel['name']); ?>

  <?php if($currentChannel['author'] == getIdFromUsername($_SESSION['username'])) { ?>
  <button text='Edit' onclick="edit('name')">Edit</button>
  <?php } ?></h1><br>




  <?php if($currentChannel['author'] == getIdFromUsername($_SESSION['username'])) { ?>
 <input id="browser-width" type="hidden" name="browser-width" value="">
  <input type="hidden" name="csrf" value="<?php echo($_SESSION['csrf']);?>">
  </form>
  <script>
  document.getElementById('browser-width').value = screen.width;
  </script>
  <?php } ?>

  <section id="channelStories" data-id="<?php echo $_GET['channelId'] ?>">
    <div class="header">
      <ul>
        <li>
          <h2>All Stories</h2>
        </li>
        <li>
          <p><a href = "../pages/new_story.php?channelId=<?php echo($_GET['channelId']); ?>" ><i class="fas fa-plus"></i> Add a story</a></p>
        </li>
      </ul>
    </div>
    <?php draw_story_list($storiesByChannel); ?>
  </section>


<?php } ?>

<?php function draw_new_channel() { ?>
  <section id="new_channel">
    <h2>Create your channel</h2>
    <form action="../actions/action_new_channel.php" method="post" enctype="multipart/form-data">
      <input id="ch_name" type="text" name="name" required placeholder="Name">
      <label>Cover image: <input type="file" name="coverImage" accept="image/*"></label>
      <input id="browser-width" type="hidden" name="browser-width" value="">
      <input type="submit" value="Create">
      <input type="hidden" name="csrf" value="<?php echo($_SESSION['csrf']);?>">
    </form>
  </section>
  <script>
  document.getElementById('browser-width').value = screen.width;
  </script>
<?php } ?>
