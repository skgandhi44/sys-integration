<?php

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');
    
    function dologin($email, $password){
        $request = array();
        $request['type'] = "Login";
        
        $request['email'] = $email;
        $request['password'] = $password;
        
        $returnedValue = createClientForDb($request);
        
        if($returnedValue == 1) {
            $_SESSION["email"] = $email;
            $_SESSION["logged"] = true;
     
        } else {
            session_destroy();
        }
        
        return $returnedValue;
    }

    function doRegister($flname, $email, $password){
        $request = array();
        
        $request['type'] = "Register";
        
        $request['flname'] = $flname;
        $request['email'] = $email;
        $request['password'] = $password;
        
        $returnedValue = createClientForDb($request);
        return $returnedValue;
    }

?>