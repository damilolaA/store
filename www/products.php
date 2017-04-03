<?php
	include 'includes/db.php';

	include 'includes/header1.php';

	include 'includes/functions.php';


	if(array_key_exists('register', $_POST)){
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

		if(empty($errors)){

			
		}

			}
?>

<div class="wrapper">
		<h1 id="register-label">Add Products</h1>
		<hr>
		<form id="register"  action ="products.php" method ="POST">
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

			<input type="submit" name="register" value="Add Product">
			</form>
	</div>


	<?php
		include 'includes/footer.php';

	?>