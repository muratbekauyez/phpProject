<?php
	require_once "config.php";
	require_once "Database.php";

	$conn = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);

	$link = $conn->connect();

/*	if(mysqli_connect_error()){
	  echo mysqli_connect_error();
	}else{
	  echo "Connected successfully"."<br>";
	}
*/
?>