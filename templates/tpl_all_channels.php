<?php function draw_channel_list($channels) { ?>

  <h1>All Channels</h1>

  <p id="order">Order By:
  <select id='orderSelector'>
    <option value="mActive">Most Active</option>
    <option value="lActive">Least Active</option>
    <option value="alphabetical">Alphabetical</option>
  </select></p>
  <script src="../js/channelOrder.js"></script>

  <div id="channelsList">
    <?php draw_channel_user($channels); ?>
  </div>
<?php } ?>

<?php function draw_channel_user($channels) { ?>
  <ul>
  <?php foreach($channels as $channel_list){ ?>
    <li><a href = "../pages/channel.php?channelId=<?php echo($channel_list['channelId']); ?>" ><?php echo($channel_list['name']); ?></a>
    <a href = "../pages/profile.php?userId=<?php echo($channel_list['author']); ?>" ><?php echo('- ' . $channel_list['username']); ?></a></li>
  <?php } ?>
</ul>
<?php } ?>
