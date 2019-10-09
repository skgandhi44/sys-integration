<?php
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    //  This function includes a file for functions
    include("function.php");
    
    session_start();
    
    
    //  Variable for type
    $type = $_GET["type"];
    //  Switch case is executed depending on the type of request
    switch ($type) {
            
        case "login":                                     
            
            $email = $_GET["email"];
            $password = $_GET["password"];
            
            $response = dologin($email, $password);
            echo $response;
            break;
            
        case "register":
            
            $flname = $_GET["flname"];
            $email = $_GET["email"];
            $password = $_GET["password"];
            
            $response = register($flname, $email, $password);
            echo $response;
            break;

        default:
            return "This is the Default case.";
    }
?>