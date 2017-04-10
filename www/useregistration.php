<?php
    
    include 'includes/db.php';

    include 'includes/functions.php';

    include 'includes/header2.php';

    $errors = [];
    if(array_key_exists('submit', $_POST)){

      if(empty($_POST['fname'])){
        $errors['fname'] = "Please enter firstname";
      }

      if(empty($_POST['lname'])){
        $errors['lname'] = "Please enter lastname";
      }

      if(empty($_POST['email'])){
        $errors['email'] = "Please enter email address";
      }

      if(empty($_POST['uname'])){
        $errors['uname'] = "Please enter username";
      }

      if(empty($_POST['pass'])){
        $errors['pass'] = "Please enter password";
      }

      if($_POST['pword'] != $_POST['pass']){
        $errors['pword'] = "Please enter correct password";
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
              <?php $show = showerrors($errors, 'fname'); echo $show;?>
        <input type="text" class="text-field first-name" name="fname" placeholder="Firstname">

              <?php $reveal = showerrors($errors, 'lname'); echo $reveal;?>
        <input type="text" class="text-field last-name" name="lname" placeholder="Lastname">

              <?php $bring = showerrors($errors, 'email'); echo $bring;?>
        <input type="email" class="text-field email" name="email" placeholder="Email">

              <?php $return = showerrors($errors, 'uname'); echo $return;?>
        <input type="text" class="text-field username" name="uname" placeholder="Username">

              <?php $top = showerrors($errors, 'pass'); echo $top;?>
        <input type="password" class="text-field password" name="pass" placeholder="Password">

              <?php $collect = showerrors($errors, 'pword'); echo $collect;?>
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