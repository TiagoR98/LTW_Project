<?php include_once('../templates/tpl_mainpage.php'); ?>

<?php function draw_channel($channel) { ?>

  <?php $channels = listChannel(); ?>
  <?php foreach($channels as $channel_list) { ?>
    <p><a href = "../pages/channel.php?channelId=<?php echo($channel_list['ID']); ?>" ><?php echo($channel_list['name']); ?></a></p>
  <?php } ?>

  <h1><?php echo($channels[$_GET['channelId']-1]['name']); ?></h1>

  <h2>All Stories</h2>
  <p><a href = "../pages/new_story.php?channelId=<?php echo($_GET['channelId']); ?>" >Add a story</a></p>

  <?php foreach($channel as $story) { ?>
    <?php draw_story_list_item($story); ?>
  <?php } ?>

<?php } ?>
