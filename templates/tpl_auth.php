<?php function draw_login($error){
  ?>

  <section id="login">
    <h1>Login</h1>
    <form action="../actions/action_login.php" method="post">
      <input type="text" name="username" placeholder="Username">
      <input type="password" name="password" placeholder="Password">
      <input type="submit" value="Login">
    </form>
    <?php if($error) {?>
      <p id="error_text">Username ou Password errados</p>
    <?php } ?>
    <p><a href="password.php">Forgot your password?</a></p>
    <p>Don't have an account?<a href="register.php">Register Now</a></p>
  </section>

<?php } ?>

<?php function draw_register(){
  ?>

  <section id="register">
    <h1>Register</h1>
    <form action="../actions/action_register.php" method="post">
      <input type="text" name="username" placeholder="Username">
      <input type="email" name="email" placeholder="E-mail">
      <input type="password" name="password" placeholder="Password">
      <input type="password" name="password_confirm" placeholder="Confirm Password">
      <input type="date" name="birth" placeholder="Birth Date" value="<?php echo(date("Y-m-d")); ?>">
      <input type="submit" value="Register">
    </form>
    <p>Already have an account?<a href="login.php">Login</a></p>
  </section>

<?php }  ?>
