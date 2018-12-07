<?php include_once('../templates/tpl_mainpage.php'); ?>

<?php function draw_channel($channel) { ?>

  <?php $channels = listChannel(); ?>
  <?php foreach($channels as $channel_list) { ?>
    <p><a href = "../pages/channel.php?channelId=<?php echo($channel_list['ID']); ?>" ><?php echo($channel_list['name']); ?></a></p>
  <?php } ?>

  <h1><?php echo($channels[$_GET['channelId']-1]['name']); ?></h1>

  <section id="channelStories" data-id="<?php echo $channel[0]['channel'] ?>">
  <h2>All Stories</h2>
  <p><a href = "../pages/new_story.php?channelId=<?php echo($_GET['channelId']); ?>" >Add a story</a></p>

  <?php draw_story_list($channel); ?>
</section>
<?php } ?>

<?php function draw_new_channel() { ?>
  <section id="new_channel">
    <h2>Create your channel</h2>
    <form action="../actions/action_new_channel.php" method="post">
      <input type="text" name="name" placeholder="Name">

      <input type="submit" value="Create">
    </form>
  </section>
<?php } ?>
