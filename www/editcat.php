<?php

	$page_title = "Edit Category";
	
	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/header1.php';

	$errors = [];
	if(array_key_exists('submit', $_POST)){

		if(empty($_POST['cat'])){
			$errors['cat'] = "Please enter category name";
		}
	}	

	if(array_key_exists('edit', $_POST)){
		$clean = array_map('trim', $_POST);
		editCategory($conn, $clean);
	}

	if(isset($_GET['success'])){
		echo $_GET['success'];
	}
?>

	
	<div class="wrapper">
		<h1 id="register-label">Edit Category</h1>
		<hr>
			<form id="register" action="editcat.php" method="POST">
			<div>
					<?php

						$show = displayErrors($errors, 'cat');
						echo $show;

					?>

			<label>Category</label>
				<input type="text" name="cat" placeholder="Category Name">
						
			<input type="submit" name="submit" value="Add">	
			</div>
				</form>
	</div>

	<?php

		include 'includes/footer.php';

	?>