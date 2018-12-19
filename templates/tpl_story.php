<?php include_once('../templates/tpl_mainpage.php'); ?>
<?php include_once('../database/db_list.php'); ?>

<?php function draw_story($story) { ?>
  <section id="story">
    <article>
      <header>
        <h1><?php echo($story['title']); ?></h1>
      </header>
      <p><?php echo($story['content']); ?></p>
      <?php if($story['image']!=NULL){ ?>
      <img id="story_image" src="../files/storyImages/<?php echo($story['image']); ?>" alt="<?php echo($story['title']); ?>'s image">
      <?php }?>
      <footer><?php draw_story_info($story); ?></footer>
    </article>
  </section>
  <script src="../js/downUpvote.js"></script>
<?php } ?>

<?php function draw_new_story($channelID) { ?>
  <?php $channels = listChannel('alphabetical'); ?>
  <section id="new_story">
    <h2>Write your story</h2>
    <form action="../actions/action_new_story.php" method="post" enctype="multipart/form-data">
      <p>Channel:
      <select name="channel" id='channelSelector'>
        <?php print_r($channels); foreach($channels as $channel_list) { ?>
          <option value="<?php echo($channel_list['channelId']); ?>"<?php if($channel_list['channelId'] == $channelID){echo("selected");} ?>><?php echo($channel_list['name']); ?></option>
        <?php } ?>
      </select></p>
      <input id="title" type="text" name="title" required placeholder="Title">
      <textarea id="story_input" name="story_input" cols="40" rows="5" required placeholder="Type your story here"></textarea>
      <label>Add an image: <input type="file" name="storyImage" accept="image/*"></label>
      <input type="submit" value="Post">
    </form>
  </section>
<?php } ?>

<?php function draw_new_comment($story) { ?>
  <section id="new_comment">
    <form action="../actions/action_add_comment.php?storyId=<?php echo($story['storyID']); ?>" method="post" enctype="multipart/form-data">
      <textarea id="content" name="content" cols="40" rows="5" required placeholder="Type your comment here"></textarea>
      <label>Add an image: <input type="file" name="commentImage" accept="image/*"></label>
      <input type="hidden" name="csrf" value="<?php echo($_SESSION['csrf']);?>">
      <input type="submit" value="Post">
    </form>
  </section>
<?php } ?>

<?php function draw_comments($comments) { ?>

  <section id="comments" data-id="<?php if(!empty($comments)) echo($comments[0]['story']); ?>">
  <div id="order_comments"><h3>All Comments</h3>
  <p>Order By:
  <select id='orderSelector'>
    <option value="mRecent">Latest</option>
    <option value="mOld">Oldest</option>
    <option value="mUpVoted">Most Upvoted</option>
    <option value="mDownVoted">Most Downvoted</option>
  </select></p></div>
  <script src="../js/commentOrder.js"></script>
  <section id="commentList">
  <?php foreach($comments as $comment) { ?>
    <?php draw_comment($comment); ?>
  <?php } ?>
  <script src="../js/commentVotes.js"></script>
</section>

  <button id="btnLoadComments">Load more comments</button>
  <script src="../js/loadComments.js"></script>
  </section>
<?php } ?>

<?php function draw_comment($comment) { ?>
  <section id="comment">
    <article >
      <header>
        <a href="../pages/profile.php?userId=<?php echo($comment['author']); ?>"><?php echo($comment['username']); ?></a>
      </header>
      <p><?php echo($comment['content']); ?></p>
      <?php if($comment['image']!=NULL){ ?>
      <img id="comment_image" src="../files/commentImages/<?php echo($comment['image']); ?>" alt="<?php echo($comment['id']); ?>'s image">
      <?php }?>
      <footer>
        <ul>
          <li><i class="fas fa-calendar-alt"></i> <?php echo($comment['date']); ?></li>
          <li class="commentUpVote" data-id="<?php echo($comment['comID']); ?>"><i class="fas fa-thumbs-up"></i> <?php echo($comment['upvotes']); ?></li>
          <li class="commentDownVote" data-id="<?php echo($comment['comID']); ?>"><i class="fas fa-thumbs-down"></i> <?php echo($comment['downvotes']); ?></li>
          <?php if($comment['username'] == $_SESSION['username']) { ?>
            <li><a href="../actions/action_delete_comment.php?commentId=<?php echo($comment['comID']); ?>&csrf=<?php echo($_SESSION['csrf']); ?>"><i class="fas fa-trash-alt"></i> Delete Comment</a></li>
          <?php } ?>
        </ul>
      </footer>
    </article>
  </section>
<?php } ?>

<?php function draw_story_list($storyInfo) { ?>
  <p id="order">Order By:
  <select id='orderSelector'>
    <option value="mRecent">Latest</option>
    <option value="mOld">Oldest</option>
    <option value="mUpVoted">Most Upvoted</option>
    <option value="mDownVoted">Most Downvoted</option>
    <option value="mComments">Most Commented</option>
  </select></p>
  <script src="../js/order.js"></script>
 </div>

  <section id="storyList">
  <?php foreach($storyInfo as $story) { ?>
    <?php draw_story_list_item($story); ?>
  <?php } ?>
  <script src="../js/downUpvote.js"></script>
  </section>

  <?php if(count($storyInfo) != 0){ ?>
  <button id="btnLoadStories">Load more stories</button>
  <script src="../js/loadStories.js"></script>
  <?php } ?>
<?php } ?>
