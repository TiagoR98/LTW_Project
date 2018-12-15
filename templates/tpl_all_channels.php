<?php function draw_channel_list($channels) { ?>
  <!--p id="order">Order By:
  <select id='orderSelector'>
    <option value="mActive">Most Active</option>
    <option value="lActive">Least Active</option>
    <option value="alphabetical">Alphabetical</option>
  </select></p-->

  <div id="channelsList">
  <?php foreach($channels as $channel_list){ ?>
    <li><a href = "../pages/channel.php?channelId=<?php echo($channel_list['ID']); ?>" ><?php echo($channel_list['name']); ?></a>
    <a href = "../pages/profile.php?userId=<?php echo($channel_list['author']); ?>" ><?php echo('- ' . $channel_list['username']); ?></a></li>
  <?php } ?>
  </div>
<?php } ?>
