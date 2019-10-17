<?php


	require_once('../rabbitmqphp_example/path.inc');
    	require_once('../rabbitmqphp_example/get_host_info.inc');
    	require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    	require_once('rabbitMQClient.php');

	session_start();
	
	$flname = ""; 
	$email = "";
	
	$errors = array();
	$request = array();

    if (isset($_POST['reg_user'])) {
	$request["type"] = "register";
		
	$flname = $_POST['flname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

        if (empty($flname)) { 
		array_push($errors, "Full Name is required"); 
        } elseif (!preg_match("/^[a-zA-Z ]*$/",$flname)){
		array_push($errors, "Only letters and white space allowed");
	} else {
		$request["flname"] = $flname;
	}
	



	if (empty($email)) {
		array_push($errors, "Email is required"); 
	} 
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		array_push($errors, "Email address is invalid");
	} else {
		$request["email"] = $email;
	}



		  
	if (empty($password) || empty($confirm_password)) { 
            array_push($errors, "Password is required"); 

	} elseif ($password != $confirm_password) {
            array_push($errors, "The two passwords do not match");

        } else {
		$request["pass"] = $password;
        }
	
	if (count($errors) == 0) {
		$result = createClientForDb($request);
		$_SESSION['email'] = $email;
        	header('location: ../php/homepage.php');
	}

    }

    if (isset($_POST['login_user'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

    	$request["type"] = "login";

        if (empty($email)) {
		array_push($errors, "Email is required"); 
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		array_push($errors, "Email address is invalid");
	} else {
		$request["email"] = $email;
	}

		  
	if (empty($password)) { 
            array_push($errors, "Password is required"); 
        } else {
		$request["pass"] = $password;
        }
	
	if (count($errors) == 0) {
		$result = createClientForDb($request);
		
		if($result == 1){	
			$_SESSION['email'] = $email;
        		header('location: ../php/homepage.php');
		} else {
			array_push($errors, "Wrong Email/Password combinations");
		}

	}

    }

?>
