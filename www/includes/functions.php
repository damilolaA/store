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

	 	$result = [];
	 	#prepare statement
	 	$stmt = $dbconn->prepare("SELECT * FROM admins WHERE email=:e");

	 	#bind params
	 	$stmt->bindParam(":e", $enter['email']);
	 	$stmt->execute();

	 	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 	#count rows returned
	 	$count = $stmt->rowCount();

	 	if($count !==1 || !password_verify($enter['password'], $row['hash'])){
	 		$result[] = false;
	 	} else {
	 		$result[] = true;
	 		$result[] = $row;
	 	}

	 	//if($count == 1){	 
	 	return $result;
	 }	


	 	function redirect($loc){

	 		header("Location: ".$loc);
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


		 function viewCategory($dbconn){

		 	$stmt = $dbconn->prepare("SELECT * FROM categories");
		 	$stmt->execute();

		 	$result = "";

		 	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

		 		$cat_id = $row['category_id'];
		 		$cat_name = $row['category_name'];


		 		$result .= '<tr><td>'.$row['category_id'].'</td>';
		 		$result .= '<td>'.$row['category_name'].'</td>';
		 		$result .= "<td><a href='editcat.php?category_id=$cat_id'>edit</a></td>";
		 		$result .= "<td><a href='category.php?dele=delete&category_id=$cat_id'>delete</a></td></tr>";

		 	}

		 		return $result;

		 }



		 function delCategory($dbconn, $look){

		 	$stmt = $dbconn->prepare("DELETE FROM categories WHERE category_id = :c");

		 	$stmt->bindParam(':c', $look);
		 	$stmt->execute();

		 	$success = "Category successfully deleted";
		 	header("Location:viewcat.php?success=$success");
		 }


		 function editCategory($dbconn, $look){

		 	$stmt = $dbconn->prepare("UPDATE categories SET category_name = :cn WHERE category_id = :ci");

		 	$data = [
		 				":cn" => $look['cat'],
		 				":ci" => $look['catid'],
		 				];
		 	$stmt->execute($data);

		 		$success = "Category successfully deleted";
		 		header("Location:viewcat.php?success=$success");
		 }


	 	function fileuploads($files, $name, $add){

	 		$data = [];
	 		# generate random number to append to name...
	 		$rnd = rand(0000000000, 9999999999);

	 		#strip file name of white spaces...
	 		$strip = str_replace(" ", "_", $files[$name]['name']);

	 		$filename = $rnd.$strip;
	 		$destination = $add .$filename;

	 		if(!move_uploaded_file($files[$name]['tmp_name'], $destination)){

	 			/*$errors[] = "file upload failed";*/
	 			$data[] = false;
	 		} else {
	 			$data[] = true;  
	 			$data[] = $destination;
	 		}	 		

	 		return $data;
	 	}


	 			function addProduct($dbconn, $add, $dest){

	 		$stmt = $dbconn->prepare("INSERT INTO books(title, author, category_id, price, flag, publication_date, isbn, book_image)
																	VALUES(:t, :a, :c, :p, :f, :pd, :i, :d)");


	 		$data = [
	 					':t' => $add['title'],
	 					':a' => $add['author'],
	 					':c' => $add['cat'],
	 					':p' => $add['price'],
	 					':f' => $add['type'],
	 					':pd'=> $add['date'],
	 					':i' => $add['isbn'], 
	 					':d' => $dest
	 					];

	 		$stmt->execute($data);			

	 		$success = "Product has been added successfully";
	 		header("Location:products.php?success=$success");
	 	}
	

	 	function delProduct ($dbconn, $name){

	 		$stmt = $dbconn->prepare("DELETE FROM books WHERE book_id = :c");

	 		$stmt->bindParam(':c', $name);
	 		$stmt->execute();

	 		$success = "Product deleted successfully";
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
	 			$type    = $row['flag'];
	 			$cat     = $row['category_id'];
	 			$date    = $row['publication_date'];
	 			$image   = $row['book_image'];
	 			$isbn    = $row['ISBN'];

	 			$state = $dbconn->prepare("SELECT category_name FROM categories WHERE category_id = :ca");
	 			$state->bindParam(':ca', $cat);
	 			$state->execute();

	 			$new = $state->fetch(PDO::FETCH_ASSOC); 

	 			$result .= '<tr><td>'.$row['title'].'</td>';
	 			$result .= '<td>'.$row['author'].'</td>';
	 			$result .= '<td>'.$new['category_name'].'</td>';
	 			$result .= '<td>'.$row['price'].'</td>';
	 			$result .= '<td>'.$row['flag'].'</td>';
	 			$result .= '<td>'.$row['publication_date'].'</td>';
	 			$result .= '<td>'.$row['ISBN'].'</td>';
	 			$result .= '<td><img src="'.$row['book_image'].'"height="50" width="50" </td>';
	 			$result .= "<td><a href='editprod.php?book_id=$book_id'>edit</a></td>";
	 			$result .= "<td><a href=viewprod.php?del=delete&book_id=$book_id>delete</a></td></tr>";
	 		}

	 		return $result;
	 	}


	 	function editProduct ($dbconn, $here){

	 		$stmt = $dbconn->prepare("UPDATE books SET title = :ti, author = :au, category_id = :ca, price = :pr,
	 												 publication_date = :pu, ISBN = :is WHERE book_id = :bi");

	 		$data = [ 
	 					':ti' => $here['title'],
	 					':au' => $here['author'],
	 					':ca' => $here['category'],
	 					':pr' => $here['price'],
	 					':pu' => $here['date'],
	 					':is' => $here['isbn'],
	 					':bi' => $here['id']
	 					];

	 		$stmt->execute($data);			

	 		$success = "Product successfully edited";
	 		header("Location:viewprod.php?success=$success");
	 	}


	 	function authenticate(){

	 		if(!isset($_SESSION['id']) && !isset($_SESSION['name'])){

	 			header("Location:login.php");
	 		}
	 	}

	 	function getBookByID($dbconn, $bookID) {
	 		$stmt = $dbconn->prepare("SELECT * FROM books WHERE book_id=:id");
	 		$stmt->bindParam(':id', $bookID);

	 		$stmt->execute();
	 		$row = $stmt->fetch(PDO::FETCH_ASSOC);

	 		return $row;
	 	}


	 	function getCategory($dbconn, $catname){

	 		$stmt = $dbconn->prepare("SELECT * FROM categories");
	 		$stmt->execute();
	 		$result = "";

	 		while($row = $stmt->fetch()){

	 			$cat_id = $row['category_id'];
	 			$cat_name = $row['category_name'];

	 			$result .= "<option value='$cat_id'>$cat_name</option>";
	 		}
	 		return $result;
	 	}


	 	function doeditCategory($dbconn, $catname){

	 		$stmt = $dbconn->prepare("SELECT * FROM categories");
	 		$stmt->execute();
	 		$result = "";

	 		while($row = $stmt->fetch()){

	 			$cat_id = $row['category_id'];
	 			$cat_name = $row['category_name'];

	 			if($cat_name == $catname) { continue ;}

	 			$result .= "<option value='$cat_id'>$cat_name</option>";
	 		}
	 		return $result;
	 	}

	 	function getcategorybyID($dbconn, $categories){
	 		$stmt = $dbconn->prepare("SELECT * FROM categories WHERE category_id = :ca");
	 		$stmt->bindParam(':ca', $categories);
	 		$stmt->execute();

	 		$row = $stmt->fetch(PDO::FETCH_ASSOC);

	 		return $row;

	 		}


	 	function viewtopselling($dbconn){

	 		$result = "Top-Selling";

	 		$stmt = $dbconn->prepare("SELECT * FROM books WHERE flag = :f");
	 		$stmt->bindParam(':f', $result);
	 		$stmt->execute();

	 		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

	 			$result .=   '<div class="display-book" style="background: url('.$row['book_image'].');"></div>';
     						// '<div class="info">';
      			$result .=	 '<h2 class="book-title">'.$row['title'].'</h2>';
       			$result .=	 '<h3 class="book-author">'.$row['author'].'</h3>';
       			$result .=	 '<h3 class="book-price">'.$row['price'].'</h3>';
       			//$result .=	 '</div>';
	 		}	
	 		
       		
       		return $result;
	 	}


	 	function viewtrending($dbconn){

	 		$result = "Trending";

	 		$stmt = $dbconn->prepare("SELECT * FROM books WHERE flag = :fg");
	 		$stmt->bindParam(':fg', $result);
	 		$stmt->execute();

	 		
	 		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	 			 		
	 		$result .= '<li class="book">
         				<a href="#"><div class="book-cover" style="background: url('.$row['book_image'].');"></div></a>
        				<div class="book-price"><p>'.$row['price'].'</p></div>
        				</li>'; 


	 		}
	 		return $result;
			 	}
	 	
	 	function recentlyviewed($dbconn){

	 		$result = "";

	 		$stmt = $dbconn->prepare("SELECT * FROM books WHERE flag IS NULL");
	 		$stmt->execute();

	 		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

	 			$result .=  '<li class="book">
        				    <a href="#"><div class="book-cover" style="background: url('.$row['book_image'].');"></div></a>
        				    <div class="book-price"><p>'.$row['price'].'</p></div>
       						</li>';
	 		}

	 		return $result;
	 	}

	 	function useregister($dbconn, $check){

	 		$hash = password_hash($check['pass'], PASSWORD_BCRYPT);

	 		$stmt = $dbconn->prepare("INSERT INTO users(fname, lname, email, username, hash)
	 									VALUES(:fn, :ln, :em, :un, :h) ");

	 		$data = [
	 				':fn' => $check['fname'],
	 				':ln' => $check['lname'],
	 				':em' => $check['email'],
	 				':un' => $check['uname'],
	 				':h'  => $hash
	 				];
	 		$stmt->execute($data);
	 	}
?>


			
			