<?php
	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/header1.php';

		
	if(array_key_exists('save', $_POST)){
			$errors = [];

		if(empty($_POST['title'])) {
			$errors[] = "Please enter book title";
		}

		if(empty($_POST['author'])) {
			$errors[] = "Please enter book author";
		}

		if(empty($_POST['cat'])) {
			$errors[] = "Please enter category id";
		}

		if(empty($_POST['price'])) {
			$errors[] = "Please enter book price";
		}

		if(empty($_POST['date'])) {
			$errors[] = "Please enter publication date";
		}

		if(empty($_POST['isbn'])) {
			$errors[] = "Please enter book isbn number";
		}


		fileUpload($_FILES, $errors, 'pic');
		#be sure a file was selected...
		if(empty($_FILES['pic']['name'])){
			$errors[] = "Please choose a file";
		
		}



		if(empty($errors)){

			$clean = array_map('trim', $_POST);

			addProduct($conn, $clean);
		}
}
			
?>

<div class="wrapper">
		<h1 id="register-label">Add Products</h1>
		<hr>
		<form id="register"  action ="products.php" method ="POST" enctype="multipart/form-data">
			<div>
				
				<label>book title:</label>
				<input type="text" name="title" placeholder="book title">
			</div>

			<div>
				<label>book author:</label>	
				<input type="text" name="author" placeholder="book author">
			</div>

			<div>
				<label>category id:</label>	
				<input type="text" name="cat" placeholder="category id">
			</div>

			<div>
				<label>price:</label>
				<input type="text" name="price" placeholder="price">
			</div>
			<div>
				<label>publication date:</label>
				<input type="text" name="date" placeholder="publication date">
			</div>
 
			<div>
				<label>isbn:</label>	
				<input type="text" name="isbn" placeholder="isbn">
			</div>

			<div>
					<label>product image</label>
					<input type="file" name="pic">
					</div>
					
					<input type="submit" name="save" value="Add Product">
					
				</form>	


		<!--	<input type="submit" name="register" value="Add Product">
			</form>   -->
	</div>


	<?php
		include 'includes/footer.php';

	?>