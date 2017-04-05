<?php
	
	session_start();

	$page_title ="Login";	

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/header.php';

	$errors = [];


	if(array_key_exists('register', $_POST)){
		
		if(empty($_POST['email'])) {
			$errors['email'] = "Please enter your email";
		}

		if(empty($_POST['password'])) {
			$errors['password'] = "Please enter your password";
		}

		if(empty($errors)) {

			#clean unwanted values in the $_POST array
			$clean = array_map('trim', $_POST);

		$chk = adminLogin($conn, $clean);

		if($chk[0]){

				$_SESSION['id'] = $chk[1]['admin_id'];
	 			$_SESSION['name'] = $chk[1]['fname'].' '.$chk[1]['lname'];
	 			redirect("category.php");
	 			
		}else {

			redirect("login.php?msg=invalid username or password");
		}
		}
	}

?>
<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="login.php" method ="POST">
			<div>
				<?php
					$reveal = displayErrors($errors, 'email');
					echo $reveal;
				?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>

			<input type="submit" name="register" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="register.php">register</a></h4>
	</div>

<?php

include 'includes/footer.php';
?>