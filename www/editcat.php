<?php

	$page_title = "Edit Category";
	
	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/header1.php';

	$errors = [];

	if(array_key_exists('edit', $_POST)){

		if(empty($_POST['cat'])){
			$errors['cat'] = "Please enter a category name";
		}

		if(empty($errors)){
		$clean = array_map('trim', $_POST);
		editCategory($conn, $clean);
		}
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
				<input type="text" name="cat" placeholder="Category Name" value="<?php echo $_GET['category_name'];?>">
						<input type="hidden" name="catid" value="<?php echo $_GET['category_id'];?>">
						<input type="submit" name="edit">
						
					</form>
					
					</div>
	</div>

	<?php

		include 'includes/footer.php';

	?>