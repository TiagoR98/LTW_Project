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
