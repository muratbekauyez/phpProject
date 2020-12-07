<?php 
	
	header('Content-Type: application/json');

	if(isset($_POST['status'])){
		$login = $_POST['login'];
		$password = $_POST['password'];
		$firstName = $_POST['firstName'];
		$secondName = $_POST['secondName'];
		$avatar = $_POST['avatar'];
		$birthday = $_POST['birthday'];



		require_once "database/link.php";
		/*CHECK IF THE SUCH USER EXISTS*/
		$stmt = $link->prepare("SELECT * FROM users WHERE login = ?");
	    $stmt->bind_param("s", $login);
	    /* execute query */
	 	$stmt->execute();

	    /* Get the result */
	   	$result = $stmt->get_result();

	    $row = $result->fetch_assoc();

		if($row != null && $row['login'] != null){
			$return = array(
            	'errorMessage' => "Login is already taken!"
        	);
		}else {
			session_start();
			$return = array(
            	'message' => "registered"
        	);
			/*INSERT INTO TABLE USER*/
        	$stmt = $link->prepare("INSERT INTO users(id, login, password, firstName,secondName,avatar,birthday) VALUES ('','$login','$password','$firstName','$secondName','$avatar','$birthday');");
			/* execute query */
		 	$stmt->execute();




		 	/*CREATE THE SESSION WITH NEEDED ID*/
		 	$stmt = $link->prepare("SELECT * FROM users WHERE login = ?");
	    	$stmt->bind_param("s", $login);
		    /* execute query */
		 	$stmt->execute();
		    /* Get the result */
		   	$result = $stmt->get_result();

		    $row = $result->fetch_assoc();
		    $_SESSION['user'] = array(
	            'id' => $row['id'],
    	       	'login' => $login,
	            'password' => $password
        	);


		}
		$stmt->close();
	}else {
		$return = array(
        	'errorMessage' => "Register attempt denied."
    	);
	}
	echo (json_encode($return));
	
