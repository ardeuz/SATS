<?php
	require  'medoo.php';

	$conn = mysqli_connect("localhost", "root", "", "sats");

 	$db = new medoo([
  	// required
  	'database_type' => 'mysql',
  	'database_name' => 'sats',
  	'server' => 'localhost',
  	'username' => 'root',
  	'password' => '',
  	'charset' => 'utf8',

    'option' => [
		    PDO::ATTR_ERRMODE,
		    PDO::ERRMODE_EXCEPTION
	  ]
  ]);
?>
