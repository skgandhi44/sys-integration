<?php

	$flname = ""; 
	$email = "";
	
	$errors = array();


    if (isset($_POST['reg_user'])) {
		
	$flname = $_POST['flname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
		
        if (empty($flname)) { 
		array_push($errors, "Full Name is required"); 
        } else {
		if (!preg_match("/^[a-zA-Z ]*$/",$flname)) {
			array_push($errors, "Only letters and white space allowed");
		}
	}
	
	if (empty("email")) {
		array_push($errors, "Email is required"); 
		
	} else {
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			array_push($errors, "Email address is invalid");
		}
	}
		  
	if (empty($password)) { 
            array_push($errors, "Password is required"); 
        }
		
        if ($password != $confirm_password) {
            array_push($errors, "The two passwords do not match");
        }
    }

    if (isset($_POST['login_user'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if(empty($email)){
           array_push($errors, 'Email is required');
        }
        
        if(empty($password)){
            array_push($errors, 'Password is required');
        }
    }

?>
