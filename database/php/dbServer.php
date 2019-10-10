<?php

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('../test/rabbitMQClient.php');
    include('connection.php');

    function login($email, $password){
        $connection = connection();
        $password = sha1($password);

        $s = "select * from users where email='$email' and password='$password'";
        $result = $connection->query($query);

        if ($result > 0){
            $_SESSION["email"] = $email;
            return true;

        } else {
            return false ;
        }
    }

    // This function registers a new user 
    function register($flname, $email, $password){
        //Makes connection to database
        $connection = connection();
        //Hashes password
        $password = sha1($password);
        
        //Query for a new user
        $newuser_query = "INSERT INTO users VALUES ('$flname', '$email', '$password')";
        $result = $connection->query($newuser_query);
        return true;
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
