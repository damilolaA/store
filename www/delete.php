

<?php
	
	include 'includes/db.php';	

	set_include_path('vms/online_store/www/category.php');

//	include 'category.php';

		if(isset($_POST['$id'])){

			if(isset($_POST['delete_id'])){

			$stmt = $conn->prepare("SELECT * FROM categories WHERE category_id = . $id");

			}	

			$stmt->execute();
				}
	?>

<form action="category.php" method="post">

	<input type="hidden" value="$id">
	<input type="submit" name="delete_id" value="Delete">
	
</form>


	