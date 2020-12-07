<?php 

	header('Content-Type: application/json');


	if(isset($_POST['status'])){
	    $login = $_POST["login"];
    	$password = $_POST["password"];

    	require_once "database/link.php";

		$stmt = $link->prepare("SELECT * FROM users WHERE login = ? AND password = ?");
	    $stmt->bind_param("ss", $login, $password);
	    /* execute query */
	 	$stmt->execute();

	    /* Get the result */
	   	$result = $stmt->get_result();

	    $row = $result->fetch_assoc();

		if($row != null && $row['login'] != null){
			session_start();
			$_SESSION['user'] = array(
				'id' => $row['id'],
	            'login' => $login,
	            'password' => $password
        	);

			$return = array(
            	'message' => "success"
        	);
		}else {
			$return = array(
            	'errorMessage' => "Incorrect login or/and password!"
        	);
		}
		$stmt->close();
	}else {
		$return = array(
        	'errorMessage' => "Login attempt denied."
    	);
	}
	echo (json_encode($return));
	
?>