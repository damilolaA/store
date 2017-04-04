<?php


	include 'includes/db.php';

	include 'includes/functions.php';



	$stmt = $conn->prepare("SELECT * FROM books");

	$stmt->execute();


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
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
						<td><?php echo $row['title'] ?></td>
						<td><?php echo $row['author'] ?></td>
						<td><?php echo $row['category_id']?></td>
						<td><?php echo $row['price']?></td>
						<td><?php echo $row['publication_date']?></td>
						<td><?php echo $row['ISBN']?></td>
						<td><img src="<?php echo $row['book_image']?>" height="50px" width="50px"></td>
						<td><a href="#">edit</a></td>
						<td><a href="#">delete</a></td>
					</tr>
					<?php }?>
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

		<img src="" >

</body>
</html>
