

<?php
	
	include 'includes/db.php';	

//	include 'category.php';

//	if(isset($_GET['category_id']) && is_numeric($_GET['category_id'])){

	$id = $_GET['id'];	
	
	$stmt = $conn->prepare("DELETE FROM categories WHERE category_id = .$id ");

	//$stmt->bindParam(':d', $delete);
	$stmt->execute();
	//$stmt->close();

	
	?>

<form action="category.php" method="post">

	<input type="hidden" name="delcat" value="$id">
	<button type="submit">DELETE</button>
	
</form>


	