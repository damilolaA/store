<?php
	
	session_start();

	$page_title = "Category";

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/header1.php';

	authenticate();

	$errors = [];

	
	if(array_key_exists('edit', $_POST)){
		$clean = array_map('trim', $_POST);
		editCategory($conn, $clean);
	}

	if(isset($_GET['success'])){
		echo $_GET['success'];
	}	

?>
	

	</section>
	<div class="wrapper">	
	<h1 id="register-label">View Category</h1>
				
			</div>
				</form>

				<br>
				<br>

		<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						<th>category id</th>
						<th>category name</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
						<?php
							$reveal = viewCategory($conn);
							echo $reveal;
							?>
          		</tbody>
			</table>
		</div>

		<div class="paginated">
			<a href="category.php">1</a>
			<a href="products.php">2</a>
			<a href="viewprod.php">3</a>
		</div>
	</div>

<?php

include 'includes/footer.php';
	
?>