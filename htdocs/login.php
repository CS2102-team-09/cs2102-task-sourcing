<html>
<?php include('header.php');?>
<form method="post" action="member.php" method="POST"> 
  <label for="uname"><b>Email</b></label>
  <input type="text" placeholder="Enter Email" name="uname" required>

  <label for="psw"><b>Password</b></label>
  <input type="password" placeholder="Enter Password" name="psw" required>

  <input type='submit' id='login_now' name='login_now' value="Login Now!">
</form>

  <?php
    if (isset($_POST['login_now'])) { 
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $_POST['uname'];
    }
  ?>

</body>
</html>
