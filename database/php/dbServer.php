<?php

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('../test/rabbitMQClient.php');
    include('connection.php');

    //Hashes password for storing
    function hashPassword($password, $salt){
        $new_pass = $password . $salt;
        return hash("sha256", $new_pass);
    }

    function login($email, $password){
        // database connection
        $connection = connection();
        
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = $connection->query($query);
        if($result){
            if($result->num_rows == 0){
                return false;
            }else{
                while ($row = $result->fetch_assoc()){
                    $salt = $row['salt']; 
                    $h_password = hashPassword($password, $salt);
                    if ($row['h_password'] == $h_password){
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }
    }

    // This function registers a new user 
    function register($flname, $email, $password){
        //Makes connection to database
        $connection = connection();
        //Generates a salt for the new user
        $salt = randomString(29);
        //Hashes password
        $h_password = hashPassword($password, $salt);
        
        //Query for a new user
        $newuser_query = "INSERT INTO users VALUES ('$flname', '$email', '$h_password', '$salt')";
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
