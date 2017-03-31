<?php
	
# title
$page_title = "Register";	

#load db connection
include 'includes/db.php';

#load functions
include 'includes/functions.php';

# include header
include 'includes/header.php';

# cache errors
	$errors = [];
if(array_key_exists('register', $_POST)){
	
	# validate first name

	if(empty($_POST['fname'])){
		$errors['fname'] = "Please enter first name";
	}

	if(empty($_POST['lname'])){
		$errors['lname'] = "Please enter last name";
	}

	if(empty($_POST['email'])){
		$errors['email'] = "Please enter email address";
	}

	if(doesEmailExist($conn, $_POST['email'])) {
		$errors['email'] = "email already exists";
	}

	if(empty($_POST['password'])){
		$errors['password'] = "Please enter password";
	}

	if($_POST['pword'] != $_POST['password']){
		$errors['pword'] = "Please enter correct password";
	}
	
	if(empty($errors)){
		// do database stuff

		# eliminate unwanted spaces from values in the $_POST array
		$clean = array_map('trim', $_POST);

		#register admin
		doAdminRegister($conn, $clean);
	}
	
}



?>
<div class="wrapper">
			
		<h1 id="register-label">Admin Register</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">

			<div>
				<?php
					
					$reveal =displayErrors($errors,'fname');
					echo $reveal;
				?>

				<label>first name:</label>
				<input type="text" name="fname" placeholder="first name">
			</div>

			<div>
				<?php
					$view = displayErrors($errors,'lname');
					echo $view;				
				?>
				<label>last name:</label>	
				<input type="text" name="lname" placeholder="last name">
			</div>

			<div>
				<?php
					$show = displayErrors($errors, 'email');
					echo $show;
				
				?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>

			<div>
				<?php
					
					$new = displayErrors($errors, 'password');
					echo $new;
				
				?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>
 
			<div>
				<?php
					$what = displayErrors($errors, 'pword');
					echo $what;
				
				?>
				<label>confirm password:</label>	
				<input type="password" name="pword" placeholder="password">
			</div>

			<input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
	</div>

<?php 

# include footer...
include 'includes/footer.php';

 ?>