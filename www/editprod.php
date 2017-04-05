<?php
	
	$page_title = "Edit Product";

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/header1.php';

	if(isset($_GET['book_id'])) {
	
	$item = getBookByID($conn, $_GET['book_id']);
	}

	$category = getcategorybyID($conn, $item ['category_id']);


	if(array_key_exists('edit',$_POST)){

		
	$errors = [];

	if(empty($_POST['title'])){
		$errors[] = "Please enter book title";
	}

	if(empty($_POST['author'])){
		$errors[] = "Please enter book author";
	}

	if(empty($_POST['price'])){
		$errors[] = "Please enter book price";
	}

	if(empty($_POST['date'])){
		$errors[] = "Please enter publication date";
	}

	if(empty($_POST['isbn'])){
		$errors[] = "Please enter book's isbn number";
	}

	if(empty($errors)){


		$clean = array_map('trim', $_POST);

		editProduct($conn, $clean);
		}
			}


		?>
	
	<div class="wrapper">
		<h1 id="register-label">Edit Product</h1>
		<hr>
		<form id="register"  action ="<?php echo "editprod.php?book_id=".$_GET['book_id']; ?>" method ="POST">
			<div>
				<label>title:</label>
				<input type="text" name="title" placeholder="book title" value="<?php echo $item['title'];?>">
			</div>
			<div>
				<label>author:</label>	
				<input type="text" name="author" placeholder="book author" value="<?php echo $item['author'];?>">
			</div>

			<div>
				<label>category:</label>
				<select name="category">
				<option>Select Category</option>
				<option value="<?php echo $category['category_id'];?>"><?php echo $category['category_name']; ?></option>
				<?php
					$catlist = doeditCategory($conn, $category['category_name']);
					echo $catlist;

				?>
					
				</select>
			</div>

			<div>
				<label>price:</label>
				<input type="text" name="price" placeholder="book price" value="<?php echo $item['price'];?>">
			</div>

			<div>
				<label>publication date:</label>
				<input type="text" name="date" placeholder="date of publication" value="<?php echo $item['publication_date'];?>">
			</div>

			<div>
				<label>isbn:</label>
				<input type="text" name="isbn" placeholder="book's isbn" value="<?php echo $item['ISBN'];?>">
			</div>

			<input type="submit" name="edit" value="edit">

		</form>

	</div>

<?php

include 'includes/footer.php';
?>