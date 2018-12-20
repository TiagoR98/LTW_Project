<?php function draw_login(){
  ?>
  <div id="login_div">
  <section id="login">
    <h1>Login</h1>
    <form action="../actions/action_login.php" method="post">
      <input type="text" name="username" placeholder="Username">
      <input type="password" name="password" placeholder="Password">
      <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="register.php">Register Now</a></p>
  </section>
</div>

<?php } ?>

<?php function draw_register(){
  ?>
  <script src="../js/confPassword.js"></script>

  <div id="register_div">
  <section id="register">
    <h1>Register</h1>
    <form action="../actions/action_register.php" method="post" id="registerForm">
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="E-mail" required>
      <input type="password" id="password" name="password" placeholder="Password" required>
      <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirm Password" required>
      <input type="text" onfocus="(this.type='date')" name="birth" placeholder="Birth Date" required>
      <input type="submit" id="submitRegister" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
  </section>
</div>

<?php }  ?>
