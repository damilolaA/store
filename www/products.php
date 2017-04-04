<?php
	
	session_start();

	$page_title = "Add Products";

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/header1.php';

	authenticate();

		$errors = [];
	if(array_key_exists('save', $_POST)){
			

		if(empty($_POST['title'])) {
			$errors['title'] = "Please enter book title";
		}

		if(empty($_POST['author'])) {
			$errors['author'] = "Please enter book author";
		}

		if(empty($_POST['cat'])) {
			$errors['cat'] = "Please enter category id";
		}

		if(empty($_POST['price'])) {
			$errors['price'] = "Please enter book price";
		}

		if(empty($_POST['date'])) {
			$errors['date'] = "Please enter publication date";
		}

		if(empty($_POST['isbn'])) {
			$errors['isbn'] = "Please enter book isbn number";
		}


	//	fileUpload($_FILES, $errors, 'pic');
		#be sure a file was selected...
		if(empty($_FILES['pic']['name'])){
			$errors[] = "Please choose a file";
		
		}



		if(empty($errors)){

			$clean = array_map('trim', $_POST);

			addProduct($conn, $clean);
		}

}	

	if(isset($_GET['success'])){
			echo $_GET['success'];
		}
			
?>

<div class="wrapper">
		<h1 id="register-label">Add Products</h1>
		<hr>
		<form id="register"  action ="products.php" method ="POST" enctype="multipart/form-data">
			<div>
					<?php
						$show = displayErrors($errors, 'title');
						echo $show;

					?>
				<label>book title:</label>
				<input type="text" name="title" placeholder="book title">
			</div>

			<div>
				<?php
					$reveal = displayErrors($errors, 'author');
					echo $reveal;
				?>
				<label>book author:</label>	
				<input type="text" name="author" placeholder="book author">
			</div>

			<div>
				<?php
					$return = displayErrors($errors, 'cat');
					echo $return;
				?>
				<label>category id:</label>	
				<input type="text" name="cat" placeholder="category id">
			</div>

			<div>
				<?php
					$bring = displayErrors($errors, 'price');
					echo $bring;
				?>
				<label>price:</label>
				<input type="text" name="price" placeholder="price">
			</div>

			<div>
				<?php
					$output = displayErrors($errors, 'date');
					echo $output;
				?>
				<label>publication date:</label>
				<input type="text" name="date" placeholder="publication date">
			</div>
 
			<div>
				<?php
					$bring = displayErrors($errors, 'isbn');
					echo $bring;
				?>
				<label>isbn:</label>	
				<input type="text" name="isbn" placeholder="isbn">
			</div>

			<div>
				<?php
					$call = displayErrors($errors, 'pic');
					echo $call;
				?>
					<label>product image</label>
					<input type="file" name="pic">
					</div>

					<input type="submit" name="save" value="Add Product">
					
				</form>	


		<!--	<input type="submit" name="register" value="Add Product">
			</form>   -->
	

	<div class="paginated">
			<a href="category.php">1</a>
			<a href="products.php">2</a>
			<a href="viewprod.php">3</a>
		</div>
	</div>


	<?php
		include 'includes/footer.php';

	?>