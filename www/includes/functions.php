<?php

	function doAdminRegister($dbconn, $input) {

	# hash the password
	$hash = password_hash($input['password'], PASSWORD_BCRYPT);

	#insert data
	$stmt = $dbconn->prepare("INSERT INTO admins(fname, lname, email, hash) 
							VALUES(:fn, :ln, :e, :h)");


	#bind params
	$data = [

			':fn' => $input['fname'],
			':ln' => $input['lname'],
			':e'  => $input['email'],
			':h'  => $hash
	];

		$stmt->execute($data);
	}

	function doesEmailExist($dbconn, $email){
		$result = false;

		$stmt = $dbconn->prepare("SELECT email FROM admins WHERE email=:e");

		#bind params
		$stmt->bindParam(":e", $email);
		$stmt->execute();

		#get number of rows returned
		$count = $stmt->rowCount();

		if($count > 0) {
			$result = true;
		}

		return $result;
	}


	function displayErrors($open, $name){

		$result = "";

		if(isset($open[$name])) {

			$result = '<span class="err">'.$open[$name].'</span>';

		}
			return $result;
	 
	 
	 }

	 function adminLogin($dbconn, $enter){

	 	#prepare statement
	 	$stmt = $dbconn->prepare("SELECT * FROM admins WHERE email=:e");

	 	#bind params
	 	$stmt->bindParam(":e", $enter['email']);
	 	$stmt->execute();

	 	#count rows returned
	 	$count = $stmt->rowCount();

	 	if($count == 1){
	 		$row = $stmt->fetch(PDO::FETCH_ASSOC);

	 		if(password_verify($enter['password'], $row['hash'])){

	 			$_SESSION['id'] = $row['admin_id'];
	 			$_SESSION['name'] = $row['fname'].' '.$row['lname'];
	 			header("Location:home.php");

	 		}else{
	 			$login_error = "Invalid email and/or password";
	 			header("Location:login.php?login_error=$login_error");
	 		}
	 	}
	 
	 }

	 	function fileUpload($right, $left, $center){

	 		define('MAX_FILE_SIZE', '2097152');

	 		$ext = ['image/jpeg', 'image/jpg', 'image/png'];

	 		# check file size
	 		if($right[$center]['size'] > MAX_FILE_SIZE) {

	 			$left[$center] = "file size exceeds maximum. maximum: " .MAX_FILE_SIZE;
	 		}

	 		# check extensions
	 		if(!in_array($right[$center]['type'], $ext)){
	 			$left[$center] = "invalid file type";
	 		}

	 		# generate random number to append to name...
	 		$rnd = rand(0000000000, 9999999999);

	 		#strip file name of white spaces...
	 		$strip = str_replace(" ", "_", $right[$center]['name']);

	 		$filename = $rnd.$strip;
	 		$destination = 'uploads/'.$filename;

	 		if(! move_uploaded_file($right[$center]['tmp_name'], $destination)){

	 			$left[$center] = "file upload failed";
	 		}
	 	}


	 	function addCategory($dbconn, $fix){

	 		$stmt = $dbconn->prepare("INSERT INTO categories(category_name)
	 										VALUES(:c)");
	 		# bind param
	 		$stmt->bindParam(':c', $fix['cat']);
	 		$stmt->execute();

	 	}


	 	function addProduct($dbconn, $add){

	 		$stmt = $dbconn->prepare("INSERT INTO books('title', 'author', 'category_id', 'price', 'publication_date', 'isbn')
																	VALUES(:t, :a, :c, :p, :pd, :i)");

	 		$data = [
	 					':t' => $add['title'],
	 					':a' => $add['author'],
	 					':c' => $add['cat'],
	 					':p' => $add['price'],
	 					':pd' => $add['date'],
	 					':i' => $add['isbn'] 
	 					];

	 		$stmt->execute($data);			
	 	}
	/* 	function viewCategory($dummy){

	 		$result = "";

	 		while($select = $dummy->fetch(PDO::FETCH_ASSOC)){

	 			$result .= '<tr><td>'.$select['category_name'].'</td>';
	 			$result .= '<td>'.$select['category_id'].'</td></tr>';
	 		}

	 		return $result;
	 	}    */
?>
