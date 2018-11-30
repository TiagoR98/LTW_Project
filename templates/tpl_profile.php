<?php function draw_profile($userInfo) { ?>

  <section id="profile">
    <img id="profile_pic" src="../files/profilePics/<?php if($userInfo['profilePic']!="") { echo($userInfo['profilePic']); } else {?>default.png<?php } ?>" alt="<?php echo($userInfo['username']); ?>'s profile picture">

    <div id="profile_info">
      <h2>Username: </h2>
      <h3><?php echo($userInfo['username']); ?></h3><br>

      <h2>Email: </h2>
      <h3><a href="mailto:<?php echo($userInfo['email']); ?>"><?php echo($userInfo['email']); ?></a></h3><br>

      <h2>Birth date: </h2>
      <h3><time datetime="<?php echo($userInfo['birth']); ?>"><?php echo($userInfo['birth']); ?></time></h3><br>

      <?php if($userInfo['username'] == $_SESSION['username']) { ?>
      <h2>Upload Profile Picture: </h2>
        <h3>
          <form action="../actions/action_edit_profile.php" method="post" enctype="multipart/form-data">
            <input type="file" name="profilePic" accept="image/*">
            <input type="submit">
          </form>
        </h3>
      <?php } ?>
      
    </div>
  </section>

<?php } ?>
