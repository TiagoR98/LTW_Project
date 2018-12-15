<?php include_once('../templates/tpl_story.php'); ?>

<?php function draw_mainpage($storyInfo) { ?>

  <div id="order_stories">
    <ul>
      <li><h2>All Stories</h2></li>
      <li><p id="addStory"><a href = "../pages/new_story.php" >Add a story</a></p></li>
    </ul>

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
    <li><a href="../pages/profile.php?userId=<?php echo($story['storyAuthor']); ?>"><i class="fas fa-user"></i> <?php echo($story['username']); ?></a></li>
    <li><a href="../pages/channel.php?channelId=<?php echo($story['channel']); ?>"><i class="fas fa-book"></i> <?php echo($story['channelName']); ?></a></li>
    <li><i class="fas fa-calendar-alt"></i> <?php echo($story['date']); ?></li>
    <li class="nUpVote" data-id="<?php echo($story['storyID']); ?>"><i class="fas fa-thumbs-up"></i> <?php echo($story['upvotes']); ?></li>
    <li class="nDownVote" data-id="<?php echo($story['storyID']); ?>"><i class="fas fa-thumbs-down"></i> <?php echo($story['downvotes']); ?></li>
    <li><i class="fas fa-comment-dots"></i> <?php echo($story['n_comments']); ?></li>
    <li><a href="../pages/new_comment.php?storyId=<?php echo($story['storyID']); ?>"><i class="fas fa-pencil-alt"></i> Write a comment</a></li>
    <?php if($story['username'] == $_SESSION['username']) { ?>
      <li><a href="../actions/action_delete_story.php?storyId=<?php echo($story['storyID']); ?>&csrf=<?php echo($_SESSION['csrf']); ?>"><i class="fas fa-trash-alt"></i> Delete Story</a></li>
    <?php } ?>
  </ul>
<?php } ?>
