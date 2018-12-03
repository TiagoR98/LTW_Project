<?php include_once('../templates/tpl_mainpage.php'); ?>

<?php function draw_story($story) { ?>
  <section id="story">
    <article>
      <header>
        <h1><?php echo($story['title']); ?></h1>
      </header>
      <p><?php echo($story['content']); ?></p>
      <footer><?php draw_story_info($story); ?></footer>
    </article>
  </section>
  <script src="../js/downUpvote.js"></script>
<?php } ?>

<?php function draw_new_story() { ?>
  <section id="new_story">
    <h2>Write your story</h2>
    <form action="../actions/action_new_story.php" method="post">
      <input type="text" name="title" placeholder="Title">
      <textarea name="story_input" cols="40" rows="5" placeholder="Type your story here"></textarea>
      <input type="submit" value="Post">
    </form>
  </section>
<?php } ?>

<?php function draw_new_comment($story) { ?>
  <section id="new_comment">
    <form action="../actions/action_add_comment.php?storyId=<?php echo($story['storyID']); ?>" method="post">
      <textarea name="content" cols="40" rows="5" placeholder="Type your comment here"></textarea>
      <input type="submit" value="Post">
    </form>
  </section>
<?php } ?>

<?php function draw_comments($comments) { ?>

  <h3>All Comments</h3>

  <?php foreach($comments as $comment) { ?>
    <?php draw_comment($comment); ?>
  <?php } ?>

<?php } ?>

<?php function draw_comment($comment) { ?>
  <section id="comment">
    <article >
      <header>
        <a href="../pages/profile.php?userId=<?php echo($comment['author']); ?>"><?php echo($comment['username']); ?></a>
      </header>
      <p><?php echo($comment['content']); ?></p>
      <footer>
        <ul>
          <li><?php echo($comment['date']); ?></li>
          <li>Upvotes: <?php echo($comment['upvotes']); ?></li>
          <li>Downvotes: <?php echo($comment['downvotes']); ?></li>
        </ul>
      </footer>
    </article>
  </section>
<?php } ?>
