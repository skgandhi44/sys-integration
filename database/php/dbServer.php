<?php

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    //require_once('../rabbitmqphp_example/rabbitMQClient.php');
    include('connection.php');


    function login($email, $password){
        $connection = connection();
        $password = md5($password);
        $s = "select * from users where email='$email' and password='$password'";
        $result = mysqli_query($connection, $s) OR die(mysqli_error());
        $num = mysqli_num_rows($result);
        if ($num > 0){
            $userEmail = $_SESSION["email"] = $email;
            return $userEmail." You are logged in!" ;
        } else {
            return "Wrong Credentials, please try again!";
        }
    }

    // This function registers a new user 
    function register($flname, $email, $password){
        //Makes connection to database
        $connection = connection();
        //Hashes password

        $password = md5($password);
        
        //Query for a new user
        $newuser_query = "INSERT INTO users (flname, email, password) VALUES ('$flname', '$email', '$password')";
        
        $resultInsert = mysqli_query($connection, $newuser_query) OR die(mysqli_error());
        //$numResult = mysqli_num_rows($resultInsert);
        
        if ($resultInsert == 1){
            $userEmail = $_SESSION["email"] = $email;
            return $userEmail." You are registered!" ;
        } else {
            return "Registration Failed!";
        }
        
    }


    // This function checks if email is valid
    function checkEmail($email){
        $connection = connection();
        
        //Query to check if the email is email
        $check_email = "SELECT * FROM users WHERE email = '$email'";
        $check_result = $connection->query($check_email);
        
        if($check_result){
            if($check_result->num_rows == 0){
                return true;
            } elseif($check_result->num_rows == 1){
                return false;
            }
        }
    }
?>
