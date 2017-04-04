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
	 			header("Location:category.php");

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

	 			define('MAX_FILE_SIZE', '2097152');

	 			$ext = ['image/jpeg', 'image/jpg', 'image/png'];

	 		# check file size
	 		if($_FILES['pic']['size'] > MAX_FILE_SIZE) {

	 			$errors[] = "file size exceeds maximum. maximum: " .MAX_FILE_SIZE;
	 		}

	 		# check extensions
	 		if(!in_array($_FILES['pic']['type'], $ext)){
	 			$errors[] = "invalid file type";
	 		}

	 		# generate random number to append to name...
	 		$rnd = rand(0000000000, 9999999999);

	 		#strip file name of white spaces...
	 		$strip = str_replace(" ", "_", $_FILES['pic']['name']);

	 		$filename = $rnd.$strip;
	 		$destination = 'uploads/'.$filename;

	 		if(! move_uploaded_file($_FILES['pic']['tmp_name'], $destination)){

	 			$errors[] = "file upload failed";
	 		}

	 		$stmt = $dbconn->prepare("INSERT INTO books(title,author, category_id, price, publication_date, isbn, book_image)
																	VALUES(:t, :a, :c, :p, :pd, :i, :d)");

	 		$destination = 'uploads/'.$filename;

	 		$data = [
	 					':t' => $add['title'],
	 					':a' => $add['author'],
	 					':c' => $add['cat'],
	 					':p' => $add['price'],
	 					':pd' => $add['date'],
	 					':i' => $add['isbn'], 
	 					':d' => $destination
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

	 	function delProduct ($dbconn, $name){

	 		$stmt = $dbconn->prepare("DELETE FROM books WHERE book_id = :c");

	 		$stmt->bindParam(':c', $name);
	 		$stmt->execute();

	 		$success = "Category deleted successfully";
	 		header("Location:viewprod.php?success=$success");
	 	}



	 	function viewProduct ($dbconn){

	 		$stmt = $dbconn->prepare("SELECT * FROM books");

	 		$stmt->execute();
	 		$result = "";

	 		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

	 			$book_id = $row['book_id'];
	 			$title   = $row['title'];
	 			$author  = $row['author'];
	 			$price   = $row['price'];
	 			$date    = $row['publication_date'];
	 			$isbn    = $row['ISBN'];

	 			$result .= '<tr><td>'.$row['title'].'</td>';
	 			$result .= '<td>'.$row['author'].'</td>';
	 			$result .= '<td>'.$row['category_id'].'</td>';
	 			$result .= '<td>'.$row['price'].'</td>';
	 			$result .= '<td>'.$row['publication_date'].'</td>';
	 			$result .= '<td>'.$row['ISBN'].'</td>';
	 			$result .= '<td><img src="'.$row['book_image'].'"height="50" width="50" </td>';
	 			$result .= "<td><a href='viewprod.php?action=edit&book_id=$book_id&title=$title&author=$author&price=$price&publication_date=$date&
	 															ISBN=$isbn'>edit</a></td>";
	 			$result .= "<td><a href=viewprod.php?del=delete&book_id=$book_id>delete</a></td></tr>";
	 		}

	 		return $result;
	 	}


	 	function editProduct ($dbconn, $here){

	 		$stmt = $dbconn->prepare("UPDATE books SET title = :ti, author = :au, price = :pr, publication_date = :pu, ISBN = :is WHERE book_id = :bi");

	 		$data = [ 
	 					':ti' => $here['title'],
	 					':au' => $here['author'],
	 					':pr' => $here['price'],
	 					':pu' => $here['publication_date'],
	 					':is' => $here['isbn'],
	 					':bi' => $here['id']
	 					];

	 		$stmt->execute($data);			
	 	}
?>
