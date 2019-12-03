<?php

  error_reporting(E_ALL);

    ini_set('display_error', 'Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', dirname(__FILE__).'/../logging/log.txt');
    
    session_start();

    if (!isset($_SESSION['email'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: ../html/login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['email']);
        header("location: ../html/login.php");
    }

    //Search Food Request
    $APIreq = array();
    $APIreqUPC = array();
    $runReq = array();
    $walkReq = array(); 
    $bicycleReq = array(); 
    $swimReq = array(); 

    // API request from backend
    if (isset($_POST['searchBtn'])) {
        if(isset($_POST['searchBar'])){
            $APIreq['type'] = 'fetchNutrients';
            $productName = $_POST['searchBar'];
            $APIreq["search_item"] = $productName;
            
            $APIreqUPC['type'] = 'fetchUPC';
            $productUPC = $_POST['searchUPC'];
            $APIreqUPC["search_item"] = $productUPC;
            
        } 
    }

?>
