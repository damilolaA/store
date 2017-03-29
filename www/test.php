<?php

	define('DBNAME', 'online_store');
	define('DBUSER', 'root');
	define('DBPASS', 'damilolo');

	$conn = new PDO("mysql:host=localhost;dbname=".DBNAME, DBUSER, DBPASS);

?>