<?php include_once('../templates/tpl_story.php'); ?>

<?php function draw_mainpage($storyInfo) { ?>

  <div id="order_stories">
    <ul>
      <li><h2>All Stories</h2></li>
      <li><p id="addStory"><a href = "../pages/new_story.php" ><i class="fas fa-plus"></i> Add a story</a></p></li>
    </ul>

  <?php draw_story_list($storyInfo); ?>

<?php } ?>

<?php function draw_story_list_item($story) { ?>
    <article>
      <header>
        <h1><a href = "../pages/story.php?storyId=<?php echo($story['storyID']); ?>" ><?php echo($story['title']); ?></a></h1>
      </header>
      <p><?php echo(substr($story['content'],0,140)); if(strlen($story['content']) > 140) echo("...");?></p>
      <?php if($story['image']!=NULL){ ?>
      <p><a href="../files/storyImages/<?php echo($story['image'])?>" target="_blank"><i class="fas fa-image"></i></a></p>
      <?php }?>
      <footer><?php draw_story_info($story); ?></footer>
    </article>
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
