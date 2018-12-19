<?php function draw_profile($userInfo) { ?>

  <?php if($userInfo['username'] == $_SESSION['username']) { ?>
  <script src="../js/editProfile.js"></script>
  <form action="../actions/action_edit_profile.php" method="post" enctype="multipart/form-data">
  <?php } ?>

  <section id="profile">
    <img id="profile_pic" src="../files/croppedProfile/<?php if($userInfo['profilePic']!="") { echo($userInfo['profilePic']); } else {?>default.png<?php } ?>" alt="<?php echo($userInfo['username']); ?>'s profile picture">

    <div id="profile_info">
      <h2><i class="fas fa-user"></i>  Username: </h2>
      <h3><?php echo($userInfo['username']); ?></h3><br>

      <h2><i class="fas fa-at"></i>  Email: </h2>
      <h3 id="emailInfo"><a href="mailto:<?php echo($userInfo['email']); ?>"><?php echo($userInfo['email']); ?></a>
      <?php if($userInfo['username'] == $_SESSION['username']) { ?>
        <button text='Edit' onclick="edit('email')">Edit</button>
      <?php } ?></h3><br>

      <h2><i class="fas fa-calendar-alt"></i>  Birth date: </h2>
      <h3 id="birthInfo"><time datetime="<?php echo($userInfo['birth']); ?>"><?php echo($userInfo['birth']); ?></time>
        <?php if($userInfo['username'] == $_SESSION['username']) { ?>
          <button text='Edit' onclick="edit('birth')">Edit</button>
        <?php } ?></h3><br>

      <?php if($userInfo['username'] == $_SESSION['username']) { ?>
        <div id="uploadPic">
          <h2><i class="fas fa-image"></i>  Upload Profile Picture: </h2>
          <h3>
              <input type="file" name="profilePic" accept="image/*">
              <input type="submit">
          </h3>
      </div>
      <?php } ?>

    </div>
  </section>

  <?php if($userInfo['username'] == $_SESSION['username']) { ?>
    <input type="hidden" name="csrf" value="<?php echo($_SESSION['csrf']);?>">
    </form>
  <?php } ?>

<?php } ?>

<?php function draw_user_stories($username, $stories) { ?>
  <section id="myStories" data-id="<?php echo $stories[0]['author'] ?>">
      <?php if($username == $_SESSION['username']) { ?>
        <ul id="myAddStory">
          <li><h1>My Stories</h1></li>
          <li><p id="addStory"><a href = "../pages/new_story.php" ><i class="fas fa-plus"></i> Add a story</a></p></li>
        </ul>
      <?php } else { ?>
        <h1><?php echo $username; ?>'s Stories</h1>
      <?php } ?>
      <?php draw_story_list($stories); ?>
  </section>
<?php } ?>
