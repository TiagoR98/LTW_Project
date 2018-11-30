<?php function draw_mainpage($storyInfo) { ?>

  <?php foreach($storyInfo as $story) { ?>
    <?php draw_story_list_item($story); ?>
  <?php } ?>

<?php } ?>

<?php function draw_story_list_item($story) { ?>
  <section id="story_preview">
    <h3><?php echo($story['title']); ?></h3>
    <p><?php echo(substr($story['content'],0,20)); ?>...</p>
    <ul>
      <li><?php echo($story['username']); ?></li>
      <li><?php echo($story['date']); ?></li>
      <li>Upvotes: <?php echo($story['upvotes']); ?></li>
      <li>Downvotes: <?php echo($story['downvotes']); ?></li>
      <li><?php echo($story['n_comments']); ?> Comments</li>
    </ul>
  </section>
<?php } ?>
