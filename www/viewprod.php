<?php


	include 'includes/db.php';

	include 'includes/functions.php';



	if(isset($_GET['del'])){

		if($_GET['del'] = "delete"){

			delProduct ($conn, $_GET['book_id']);
		}
	}

?>
<!DOCTYPE html>
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
	</section>
	<div class="wrapper">
		<div id="stream">
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

	<section class="foot">
		<div>
			<p>&copy; 2016;
		</div>
	</section>

</body>
</html>
