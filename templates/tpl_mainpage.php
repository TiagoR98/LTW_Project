<?php include_once('../templates/tpl_story.php'); ?>

<?php function draw_mainpage($storyInfo) { ?>

  <?php $channels = listChannel(); ?>
  <?php foreach($channels as $channel) { ?>
    <p><a href = "../pages/channel.php?channelId=<?php echo($channel['ID']); ?>" ><?php echo($channel['name']); ?></a></p>
  <?php } ?>

  <h2>All Stories</h2>
  <p><a href = "../pages/new_story.php" >Add a story</a></p>

  <?php draw_story_list($storyInfo); ?>

<?php } ?>

<?php function draw_story_list_item($story) { ?>
  <section id="story_preview">
    <h3><a href = "../pages/story.php?storyId=<?php echo($story['storyID']); ?>" ><?php echo($story['title']); ?></a></h3>
    <p><?php echo(substr($story['content'],0,20)); ?>...</p>
    <?php draw_story_info($story); ?>

  </section>
<?php } ?>

<?php function draw_story_info($story) { ?>
  <ul>
    <li><a href="../pages/profile.php?userId=<?php echo($story['author']); ?>"><?php echo($story['username']); ?></a></li>
    <li><?php echo($story['date']); ?></li>
    <li class="nUpVote" data-id="<?php echo($story['storyID']); ?>">Upvotes: <?php echo($story['upvotes']); ?></li>
    <li class="nDownVote" data-id="<?php echo($story['storyID']); ?>">Downvotes: <?php echo($story['downvotes']); ?></li>
    <li><?php echo($story['n_comments']); ?> Comments</li>
    <li><a href="../pages/new_comment.php?storyId=<?php echo($story['storyID']); ?>"> Write a comment</a></li>
  </ul>
<?php } ?>
