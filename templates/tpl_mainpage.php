<?php function draw_mainpage($storyInfo) { ?>

  <?php for ($i = 0; $i < count($storyInfo); $i++) { ?>
  <section id="story_preview">
    <h3><?php echo($storyInfo[$i]['title']); ?></h3>
    <p><?php echo($storyInfo[$i]['content']); ?></p>
    <ul>
      <li><?php echo($storyInfo[$i]['username']); ?></li>
      <li><?php echo($storyInfo[$i]['date']); ?></li>
      <li>Upvotes: <?php echo($storyInfo[$i]['upvotes']); ?></li>
      <li>Downvotes: <?php echo($storyInfo[$i]['downvotes']); ?></li>
      <li><?php echo($storyInfo[$i]['n_comments']); ?> Comments</li>
    </ul>
  </section>
  <?php } ?>

<?php } ?>
