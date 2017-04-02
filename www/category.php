<?php

	include "includes/db.php";

	include "includes/functions.php";

	$error = [];

	if (array_key_exists('submit', $_POST)){

		if(empty($_POST['cat'])){
			$error['cat'] = "Please enter a category name";
		}

		if(empty($error)){

			$clean = array_map('trim', $_POST);

			addCategory($conn, $clean);

			
		}
	}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Category</title>
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>

<body>
	<section>
		<div class="mast">
			<h1>T<span>SSB</span></h1>
			<nav>
				<ul class="clearfix">
					<li><a href="category.php" class="selected">Category</a></li>
					<li><a href="#">Products</a></li>
					<li><a href="#">Logout</a></li>
				</ul>
			</nav>
		</div>
	</section>

	<div class="wrapper">	
	<h1 id="register-label">Add Category</h1>
	<hr>
		<form id="register" action="category.php" method="POST" >

		<div>
			<?php
				$show = displayErrors($error, 'cat');
				echo $show;
			?>
			<label>Category:</label>
			<input type="text" name="cat" placeholder="Category">
		</div>

			<input type="submit" name="submit" value="Register">
		</form>

		<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						<th>post title</th>
						<th>post author</th>
						<th>date created</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>the knowledge gap</td>
						<td>maja</td>
						<td>January, 10</td>
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
