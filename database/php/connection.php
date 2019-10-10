<?php

    function connection(){
        $hostname = "127.0.0.1"; 			// or "sql2.njit.edu"   OR "SQL1.NJIT.EDU"
        $username = "IT490_user";   // ucid 
        $project  = "IT490";  // ucid
        $password = "MySQL123!";  
        
        $connection = mysqli_connect($hostname, $username, $password, $project);
        
        if (!$connection){
            echo "Error Connecting to Database: " . $connection->connect_errno.PHP_EOL;
            exit();
        }
        
        echo "Connection Established to Database" . PHP_EOL;
        return $connection;
    }

?>
