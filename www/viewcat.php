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
					<li><a href="viewcat.php">View Products</a></li>
					<li><a href="#">logout</a></li>
				</ul>
			</nav>
		</div>
	</section>
	<div class="wrapper">
		<div id="stream">
		<h1 id="register-label">Add Category</h1>
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
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="#">edit</a></td>
						<td><a href="#">delete</a></td>
					</tr>
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
