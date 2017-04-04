<?php


	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/header1.php';



	if(isset($_GET['del'])){

		if($_GET['del'] = "delete"){

			delProduct ($conn, $_GET['book_id']);
		}
	}


	if(array_key_exists('edit', $_POST)){

		$clean = array_map('trim', $_POST);

			editProduct($conn, $clean);

		}

			if(isset($_GET['success'])){

				echo $_GET['success'];
			}
	

?>
<!-- <!DOCTYPE html>
<html>
<head>
	<title>View Category</title>
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>

<body>
	<section>
		<div class="mast">
			<h1>T<span>SSB</span></h1>
			<nav>
				<ul class="clearfix">
					<li><a href="category.php" class="selected">Add Category</a></li>
					<li><a href="products.php">Add Products</a></li>
					<li><a href="viewprod.php">View Products</a></li>
					<li><a href="#">logout</a></li>
				</ul>
			</nav>
		</div>
	</section>  -->
	<div class="wrapper">
		<div id="stream">

			<?php 
				if(isset($_GET['action'])){

					if($_GET['action'] = "edit"){



			?>

		<h3>Edit Product</h3>

		<form id="register" action="viewprod.php" method="POST">
			
			<input type="text" name="title" placeholder="Book Title" value="<?php echo $_GET['title'];?>">
			<input type="text" name="author" placeholder="Book Author" value="<?php echo $_GET['author'];?>">
			<input type="text" name="price" placeholder="Book Price" value="<?php echo $_GET['price'];?>">
			<input type="text" name="publication_date" placeholder="Publication Date" value="<?php echo $_GET['publication_date'];?>">
			<input type="text" name="isbn" placeholder="ISBN of book" value="<?php echo $_GET['ISBN'];?>">
			<input type="hidden" name="id" value="<?php echo $_GET['book_id'];?>">	
			<input type="submit" name="edit" value="edit">


		</form>

			<?php 
						}
					}
			 ?>

		<h1 id="register-label">View Products</h1>
			<table id="tab">
				<thead>
					<tr>
						<th>title</th>
						<th>author</th>
						<th>category</th>
						<th>price</th>
						<th>publication date</th>
						<th>isbn</th>
						<th>image</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
					
						
					<?php	$show = viewProduct($conn);  echo $show;  ?>
					
					
          		</tbody>
			</table>
		</div>

		<div class="paginated">
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>
			<a href="#">2</a>
		</div>
	</div>

	<?php

		include 'includes/footer.php';

	?>
