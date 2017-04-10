<?php
    
    include 'includes/header2.php';

    if(array_key_exists('submit', $_POST)){

      $errors = [];

      if(empty($_POST['fname'])){
        $errors[] = "Please enter firstname";
      }

      if(empty($_POST['lname'])){
        $errors[] = "Please enter lastname";
      }

      if(empty($_POST['email'])){
        $errors[] = "Please enter email address";
      }

      if(doesEmailExists($conn, $_POST['email'])){
        $errors[] = "Email already exists";
      }

      if(empty($_POST['uname'])){
        $errors[] = "Please enter username";
      }

      if(empty($_POST['pass'])){
        $errors[] = "Please enter password";
      }

      if($_POST['pword'] != $_POST['pass']){
        $errors[] = "Please enter correct password";
      }

      if(empty($errors)){

        $clean = array_map('trim', $_POST);

        useregister($conn, $clean);
      }
    }
?>
  <!-- main content starts here -->
  <div class="main">
    <div class="registration-form">
      <form class="def-modal-form" action="useregistration.php" method="POST">
        <div class="cancel-icon close-form"></div>
        <label for="registration-from" class="header"><h3>User Registration</h3></label>
        <input type="text" class="text-field first-name" name="fname" placeholder="Firstname">
        <input type="text" class="text-field last-name" name="lname" placeholder="Lastname">
        <input type="email" class="text-field email" name="email" placeholder="Email">
        <input type="text" class="text-field username" name="uname" placeholder="Username">
        <input type="password" class="text-field password" name="pass" placeholder="Password">
        <input type="password" class="text-field confirm-password" name="pword" placeholder="Confirm Password">
        <input type="submit" class="def-button" name="submit" value="Register">
        <p class="login-option">Have an account already? Login</p>
      </form>
    </div>
  </div>
  <!-- footer starts here-->
 <?php
 include 'includes/footer2.php';

 ?>