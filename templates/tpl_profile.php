<?php function draw_profile($userInfo) { ?>

  <?php if($userInfo['username'] == $_SESSION['username']) { ?>
  <script src="../js/editProfile.js"></script>
  <form action="../actions/action_edit_profile.php" method="post" enctype="multipart/form-data">
  <?php } ?>

  <section id="profile">
    <img id="profile_pic" src="../files/croppedProfile/<?php if($userInfo['profilePic']!="") { echo($userInfo['profilePic']); } else {?>default.png<?php } ?>" alt="<?php echo($userInfo['username']); ?>'s profile picture">

    <div id="profile_info">
      <h2>Username: </h2>
      <h3><?php echo($userInfo['username']); ?></h3><br>

      <h2>Email: </h2>
      <h3 id="emailInfo"><a href="mailto:<?php echo($userInfo['email']); ?>"><?php echo($userInfo['email']); ?></a>
      <?php if($userInfo['username'] == $_SESSION['username']) { ?>
        <button text='Edit' onclick="edit('email')">Edit</button>
      <?php } ?></h3><br>

      <h2>Birth date: </h2>
      <h3 id="birthInfo"><time datetime="<?php echo($userInfo['birth']); ?>"><?php echo($userInfo['birth']); ?></time>
        <?php if($userInfo['username'] == $_SESSION['username']) { ?>
          <button text='Edit' onclick="edit('birth')">Edit</button>
        <?php } ?></h3><br>

      <?php if($userInfo['username'] == $_SESSION['username']) { ?>
      <h2>Upload Profile Picture: </h2>
        <h3>
            <input type="file" name="profilePic" accept="image/*">
            <input type="submit">
        </h3>
      <?php } ?>

    </div>
  </section>

  <?php if($userInfo['username'] == $_SESSION['username']) { ?>
    </form>
  <?php } ?>

<?php } ?>

<?php function draw_user_stories($username, $stories) { ?>
  <section id="myStories" data-id="<?php echo $stories[0]['author'] ?>">
      <?php if($username == $_SESSION['username']) { ?>
        <h1>My Stories</h1>
      <?php } else { ?>
        <h1><?php echo $username; ?>'s Stories</h1>
      <?php } ?>
      <?php draw_story_list($stories); ?>
  </section>
<?php } ?>
