<?php


	require_once('../rabbitmqphp_example/path.inc');
	require_once('../rabbitmqphp_example/get_host_info.inc');
	require_once('../rabbitmqphp_example/rabbitMQLib.inc');
	require_once('rabbitMQClient.php');

   	//error logging
    	error_reporting(E_ALL);

    	ini_set('display_error', 'Off');
    	ini_set('log_errors', 'On');
    	ini_set('error_log', dirname(__FILE__).'/../logging/log.txt');

	session_start();
	
	$flname = ""; 
	$email = "";
	$PhoneNumber = "";
    	$heightInInches = "";
    	$weightInPound = "";
	
	$errors = array();
	$request = array();

    if (isset($_POST['reg_user'])) {
        $request["type"] = "register";

        $flname = $_POST['flname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $heightInInches = $_POST['heightInInches'];
        $weightInPound = $_POST['weightInPound'];

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

	if (empty($PhoneNumber)) {
            array_push($errors, "Phone Number is required"); 
        } else {
            $request["PhoneNumber"] = $PhoneNumber;
        }


        if (empty($password) || empty($confirm_password)) { 
            array_push($errors, "Password is required"); 
        } elseif ($password != $confirm_password) {
            array_push($errors, "The two passwords do not match");

        } else {
            $request["pass"] = $password;
        }


        if(empty($heightInInches)){
            array_push($errors, "Inches is required");
        } else {
            $request["heightInInches"] = $heightInInches;
        }

        if(empty($weightInPound)){
            array_push($errors, "Weight is required");
        } else {
            $request["weightInPound"] = $weightInPound;
        }

        if (count($errors) == 0) {
            $result = createClientForDb($request);
            $_SESSION['email'] = $email;
            $_SESSION['flname'] = $flname;
            header('location: ../html/profile.php');
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

    if(isset($_POST['user_allergy'])){
        $request["type"] = "allergy";
        
        $A1= $_POST['A1'];
        $A2= $_POST['A2'];
        $A3= $_POST['A3'];
        $A4= $_POST['A4'];
        $A5= $_POST['A5'];
        $A6= $_POST['A6'];
        $A7= $_POST['A7'];
        $A8= $_POST['A8'];
        $A9= $_POST['A9'];
        
        if($A1=="on") $A1=1; else $A1=0;
        if($A2=="on") $A2=1; else $A2=0;
        if($A3=="on") $A3=1; else $A3=0;
        if($A4=="on") $A4=1; else $A4=0;
        if($A5=="on") $A5=1; else $A5=0;
        if($A6=="on") $A6=1; else $A6=0;
        if($A7=="on") $A7=1; else $A7=0;
        if($A8=="on") $A8=1; else $A8=0;
        if($A9=="on") $A9=1; else $A9=0;
        
        $request["email"] = $_SESSION['email'];
        $request["A1"] = $A1;
        $request["A2"] = $A2;
        $request["A3"] = $A3;
        $request["A4"] = $A4;
        $request["A5"] = $A5;
        $request["A6"] = $A6;
        $request["A7"] = $A7;
        $request["A8"] = $A8;
        $request["A9"] = $A9;
        
        if (count($errors) == 0) {
            $result = createClientForDb($request);
            header('location: ../php/homepage.php');
        }
    }

?>
