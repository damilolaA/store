<?php
	
	$page_title = "Category";

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/header1.php';

	$errors = [];

	if(array_key_exists('submit', $_POST)){		

		if(empty($_POST['cat'])){

			$errors['cat'] = "Please enter category name";
		}

		if(empty($errors)){

			$clean = array_map('trim', $_POST);

			addCategory($conn, $clean);
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
	

	</section>
	<div class="wrapper">	
	<h1 id="register-label">Add Category</h1>

	<hr>

						<?php

							if(isset($_GET['action'])){

								if($_GET['action'] = "edit"){

						?>

					<h3>Edit Category</h3>
					<form id="register" action="category.php" method="POST">

						<input type="text" name="catname" placeholder="Category Name" value="<?php echo $_GET['category_name'];?>">
						<input type="hidden" name="catid" value="<?php echo $_GET['category_id'];?>">
						<input type="submit" name="edit">
						
					</form>
					<?php
						}
							}
								?>

			<form id="register" action="category.php" method="POST">
			<div>
					<?php

						$show = displayErrors($errors, 'cat');
						echo $show;



					if(isset($_GET['dele'])){

		if($_GET['dele'] = "delete"){

			delCategory($conn, $_GET['category_id']);
		}
	}
	
					?>
				
			<label>Category</label>
				<input type="text" name="cat" placeholder="Category Name">
						
			<input type="submit" name="submit" value="Add">	
			</div>
				</form>

				<br>
				<br>

		<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						<th>category id</th>
						<th>category name</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
						<?php
							$reveal = viewCategory($conn);
							echo $reveal;
							?>
          		</tbody>
			</table>
		</div>

		<div class="paginated">
			<a href="category.php">1</a>
			<a href="products.php">2</a>
			<a href="viewprod.php">3</a>
		</div>
	</div>

<?php

include 'includes/footer.php';
	
?>