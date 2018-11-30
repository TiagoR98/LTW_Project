<?php function draw_mainpage($storyInfo) { ?>

  <?php for ($i = 1; $i <= 10; $i++) { ?>
  <section id="story_preview">
    <h3><?php echo($storyInfo['title']); ?></h3>
    <ul>
      <li><?php echo($storyInfo['author']); ?></li>
      <li><?php echo($storyInfo['date']); ?></li>
      <li><?php echo($storyInfo['upvotes']); ?></li>
      <li><?php echo($storyInfo['downvotes']); ?></li>
      <li>Comments</li>
    </ul>
  </section>
  <?php } ?>

<?php } ?>
