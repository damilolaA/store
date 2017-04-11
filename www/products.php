<?php
	
	session_start();

	$page_title = "Add Products";

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/header1.php';

	$book = array("Top-Selling", "Trending", 'Recently-Viewed');

	authenticate();

		$errors = [];
	if(array_key_exists('save', $_POST)){
			
		define('MAX_FILE_SIZE', '2097152');

	 	$ext = ['image/jpeg', 'image/jpg', 'image/png'];

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

		if(empty($_POST['type'])) {
			$errors['type'] = "Please select book type";
		}

		if(empty($_POST['date'])) {
			$errors['date'] = "Please enter publication date";
		}

		if(empty($_POST['isbn'])) {
			$errors['isbn'] = "Please enter book isbn number";
		}

		if($_FILES['pic']['size'] > MAX_FILE_SIZE) {

	 	$errors[] = "file size exceeds maximum. maximum: " .MAX_FILE_SIZE;
	 		
	 		}

	 	if(!in_array($_FILES['pic']['type'], $ext)){
	 			$errors[] = "invalid file type";
	 		}

		if(empty($errors)){

			$check = fileuploads($_FILES, 'pic', 'uploads/');
		if($check[0]){					#$check[0] returns fileupload is successful
			 $destination = $check[1];    #$check[1] holds the destination
		}else {
			$errors['pic'] = "file upload failed";
		}

			$clean = array_map('trim', $_POST);

			addProduct($conn, $clean, $destination);

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
				<label>category name:</label>	
				<select name="cat">
					<option value="">Select</option>
					<?php $show = getCategory($conn); echo $show; ?>
				</select>
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
					$review = displayErrors($errors, 'type');
					echo $review;
				?>
				<label>Book Type:</label>	
				<select name="type">
					<option value="">Select</option>
					<?php foreach($book as $books){?>
					<option value="<?php echo $books;?>"><?php echo $books; ?></option>
					<?php } ?>
				</select>
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