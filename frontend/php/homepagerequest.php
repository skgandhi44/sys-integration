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

  $APIresult = createClientForDmz($APIreq);

    $foodResultParse = $APIresult['foods'];
    for($i=0; $i < count($foodResultParse); $i++){
        $product = $foodResultParse["$i"];
        $productPhoto = $product['photo']['highres'];
        $product_name = $product["food_name"];
        $productServingCount = $product['serving_qty'];
        $productServingUnit = $product['serving_unit'];
        $productServingWeight = $product['serving_weight_grams'];
        $productFat = $product['nf_total_fat'];
        $productCalories = $product['nf_calories'];
        $productSaturateFat = $product['nf_saturated_fat'];
        $productCholesterol = $product['nf_cholesterol'];
        $productDietaryFiber = $product['nf_dietary_fiber'];
        $productSugar = $product['nf_sugars'];
        $productProtin = $product['nf_protein'];
        $productPotassium = $product['nf_potassium'];
        
    }

    $APIresultUPC = createClientForDmz($APIreqUPC);

    $foodResultParseUPC = $APIresultUPC['foods'];
    for($i=0; $i < count($foodResultParseUPC); $i++){
        $product = $foodResultParseUPC["$i"];
        $productPhoto = $product['photo']['thumb'];
        $product_name = $product["food_name"];
        $productServingCount = $product['serving_qty'];
        $productServingUnit = $product['serving_unit'];
        $productServingWeight = $product['serving_weight_grams'];
        $productFat = $product['nf_total_fat'];
        $productCalories = $product['nf_calories'];
        $productSaturateFat = $product['nf_saturated_fat'];
        $productCholesterol = $product['nf_cholesterol'];
        $productDietaryFiber = $product['nf_dietary_fiber'];
        $productSugar = $product['nf_sugars'];
        $productProtin = $product['nf_protein'];
        $productPotassium = $product['nf_potassium'];
        $productClaims = $product['claims'];
//        print_r($productClaims);
        //echo nl2br ("\n");
    }

?>
