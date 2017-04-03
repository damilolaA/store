

<?php
	
	include 'includes/db.php';	

	if(isset($_POST['deletecat']) && is_numeric($_POST['deletecat'])){

	$delete = $_POST['deletecat'];	
	
	$stmt = $conn->prepare("DELETE FROM categories WHERE category_id = $delete LIMIT 1");

	//$stmt->bindParam(':d', $delete);
	$stmt->execute();
	//$stmt->close();

	}
	?>


	<form action="category.php" method="POST">


	<input type="hidden" name="deletecat" >
	<input type="submit" value="Delete">
		
	</form>


	