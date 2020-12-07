<?php
	session_start();
	setcookie(session_name(), '', 100);
	unset($_SESSION['user']);
	session_unset();
	session_destroy();
	$_SESSION = array();
	header("Location: index.php");	
?>