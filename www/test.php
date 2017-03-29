<?php

/*	define('DBNAME', 'online_store');
	define('DBUSER', 'root');
	define('DBPASS', 'damilolo');

	try{

	# prepare a PDO instance	
	$conn = new PDO("mysql:host=localhost;dbname=".DBNAME, DBUSER, DBPASS);

	# set verbose error modes
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

	} catch(PDOException $e){
		echo $e->getMessage();
	}    */

	# max file size
	define('MAX_FILE_SIZE', '2097152');

	if(array_key_exists('save', $_POST)){
		$errors = [];

		#be sure a file was selected...
		if(empty($_FILES['pic']['name'])){
			$errors['pic'] = "Please choose a file";
		}

		# check file size...
		if($_FILES['pic']['size'] > MAX_FILE_SIZE){
			$errors['pic'] = "file size exceeds maximum. maximum: ". MAX_FILE_SIZE;
		}

		if(empty($errors)){
			echo "done";
		}else {
			foreach($errors as $err){
				echo $err. '</br>';
			}
		}

	}
?>

<form id="register" method="POST" enctype="multipart/form-data">
	<p>Please upload a file</p>

	<input type="file" name="pic">

	<input type="submit" name="save">
</form>