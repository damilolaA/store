<?php
	
# title
$page_title = "Register";	

# include header
include 'includes/header.php';

if(array_key_exists('register', $_POST)){
	# cache errors
	$errors = [];

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

	if(empty($_POST['password'])){
		$errors['password'] = "Please enter password";
	}

	if(empty($_POST['pword'])){
		$errors['pword'] = "Please confirm password";
	}

	if($_POST['pword'] != $_POST['password']){
		$errors['pword'] = "Please enter correct password";
	}
	
	if(empty($errors)){
		// do database stuff
	}
	
}



?>
<div class="wrapper">
		<h1 id="register-label">Admin Register</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">
			<div>
				<?php
					if(isset($errors['fname'])) {echo '<span class="err">'. $errors['fname']. '</span>';}

				?>
				<label>first name:</label>
				<input type="text" name="fname" placeholder="first name">
			</div>
			<div>
				<label>last name:</label>	
				<input type="text" name="lname" placeholder="last name">
			</div>

			<div>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>
 
			<div>
				<label>confirm password:</label>	
				<input type="password" name="pword" placeholder="password">
			</div>

			<input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
	</div>

</<?php 

# include footer...
include 'includes/footer.php';

 ?>