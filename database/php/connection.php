<?php
    
    ///////////////////// Error checking ///////////////////////////

    error_reporting(E_ERROR | E_WARNING | E_PASE | E_NOTICE);
    ini_set('display_errors', 1);

    include ("account.php");

///////////////////// Database connection ///////////////////////////

    $db = mysqli_connect($hostname, $username, $password, $project);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    mysqli_select_db($db, $project);
?>