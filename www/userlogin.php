<?php

  include 'includes/db.php';

  include 'includes/functions.php';

  include 'includes/header2.php';


  $errors = [];

  if(array_key_exists('enter', $_POST)){

      if(empty($_POST['email'])){
        $errors['email'] = "Please enter email address";
      }

      if(empty($_POST['pass'])){
        $errors['pass'] = "Please enter your password";
      }

      if(empty($errors)){

        $clean = array_map('trim', $_POST);

        $get = userlogin($conn, $clean);

        if($get[0]){

            $_SESSION['id'] = $get[1]['user_id'];
            $_SESSION['email'] = $get[1]['email'];
            redirect("home.php");
        }else {

            redirect("userlogin.php? msg = invalid email and/or password");
        }
      }
  }


?>
  <!-- main content starts here -->
  <div class="main">
    <div class="login-form">
      <form class="def-modal-form" action="userlogin.php" method="post">
        <div class="cancel-icon close-form"></div>
        <label for="login-form" class="header"><h3>Login</h3></label>
        <input type="text" class="text-field email" name="email" placeholder="Email">
  <     <p class="form-error"><?php $reveal = showerrors($errors, 'email'); echo $reveal; ?></p>  
        <input type="password" class="text-field password" name="pass" placeholder="Password">
        <!--clear the error and use it later just to show you how it works   -->
        <p class="form-error"><?php $bring = showerrors($errors,'pass'); echo $bring; ?></p> 
        <input type="submit" class="def-button login" name="enter" value="Login">
      </form>
    </div>
  </div>
  <!-- footer starts here-->
 <?php 

  include 'includes/footer2.php';
 ?>