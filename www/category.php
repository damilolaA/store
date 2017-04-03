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


	$stmt = $conn->prepare("SELECT * FROM categories");

	$stmt->execute();

	if(isset($_GET['category_id'])){

		 $id = $_GET['category_id'];

			delCategory($conn, $id);
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
					<li><a href="category.php" class="selected">Add Category</a></li>
					<li><a href="products.php">Add Products</a></li>
					<li><a href="viewprod.php">View Products</a></li>
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

		</br>
		<hr>
		<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						<th>Category Name</th>
						<th>Category ID</th>
						<th>Edit Category</th>
						<th>Delete Category</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						
				<?php	while($select = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
					
						<td><?php echo $select['category_name'] ?></td>
						<td><?php echo $select['category_id']?></td>	

						<?php	$id = $select['category_id'];  ?>
						<td><a href="edit.php? id=<?php $id; ?>">edit</a></td>
						<td><a href="category.php?del=delete&category_id=$id">delete</a></td>

					</tr>   
					<?php } ?>
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
