<?php

    //error logging
// 016000507258
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


// Total Calories Display

    $getTotalCalories = array();
    $getTotalCalories["type"] = "getTotalCalories";
    $getTotalCalories["email"] = $_SESSION['email'];
    $getTotalCaloriesResults = createClientForDb($getTotalCalories);

    // Running Request

    $runReq['type'] = 'fetchExcercise';
    $runReq["search_item"] = $getTotalCaloriesResults.' calories Running';
    
    // Walking Request
    $walkReq['type'] = 'fetchExcercise';
    $walkReq["search_item"] = $getTotalCaloriesResults.' calories Walking';
    
    //Bicycle Request
    $bicycleReq['type'] = 'fetchExcercise';
    $bicycleReq["search_item"] = $getTotalCaloriesResults.' calories Bicycle';
    
    //Swimming Request
    $swimReq['type'] = 'fetchExcercise';
    $swimReq["search_item"] = $getTotalCaloriesResults.' calories Swimming';

    $runResults = createClientForDmz($runReq);
    $walkResults = createClientForDmz($walkReq);
    $bicycleResults = createClientForDmz($bicycleReq);
    $swimResults = createClientForDmz($swimReq);

//    print_r($runResults);
    $runResultParse = $runResults['exercises'];
    for($x=0; $x < count($runResultParse); $x++){
        $running = $runResultParse["$x"];
        $runDuration = $running['duration_min'];
        $runName = $running['name'];
        $runCalories = $running['nf_calories'];
        //echo $runCalories;
    }

    $walkResultParse = $walkResults['exercises'];
    for($i=0; $i < count($walkResultParse); $i++){
        $walking = $walkResultParse["$i"];
        $walkDuration = $walking['duration_min'];
        $walkName = $walking['name'];
        $walkCalories = $walking['nf_calories'];
    }

    $bicycleResultParse = $bicycleResults['exercises'];
    for($i=0; $i < count($bicycleResultParse); $i++){
        $bicycle = $bicycleResultParse["$i"];
        $bicycleDuration = $bicycle['duration_min'];
        $bicycleName = $bicycle['name'];
        $bicycleCalories = $bicycle['nf_calories'];
    }

    $swimResultParse = $swimResults['exercises'];
    for($i=0; $i < count($swimResultParse); $i++){
        $swimming = $swimResultParse["$i"];
        $swimDuration = $swimming['duration_min'];
        $swimName = $swimming['name'];
        $swimCalories = $swimming['nf_calories'];
    }

// BMI Request
    $request = array();
    $request["type"] = "UserBMI";
    $request['email'] = $_SESSION['email'];
    $result = createClientForDb($request);

    if($result <= 18.5){
        $BMI_Category = 'Underweight';
    }
    elseif ($result >= 18.5 and $result <= 24.9){
        $BMI_Category = 'Normal Weight';
    }
    elseif ($result >= 25 and $result <= 29.9){
        $BMI_Category = 'Over-Weight';
    }
    else {
        $BMI_Category = 'Obesity';
    }


// User Products for the day

    $getUserProd = array();
    $getUserProd["type"] = "getUserProduct";
    $getUserProd["email"] = $_SESSION['email'];
    $getUserProdResults = createClientForDb($getUserProd);

    $getUserProdParse = $getUserProdResults['userProductInfo'];

?>
