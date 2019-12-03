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

    // Allergy Request
//    $requestAllergy = array();
//    $requestAllergy["type"] = "UserAllergy";
//    $requestAllergy['email'] = $_SESSION['email'];
//    $userAllergyResult = createClientForDb($requestAllergy);

//    print_r($userAllergyResult);
//Array ( 
//    [allergyInfo] => Array ( 
//        [0] => Array ( 
//            [Egg] => 0 
//            [Soy] => 1 
//            [Milk] => 0 
//            [Peanuts] => 0 
//            [Shellfish] => 1 
//            [Wheat] => 0 
//            [Gluten] => 1 
//            [Treenut] => 0 
//            [Fish] => 0 
//        ) 
//    ) 
//) 

//    foreach($userAllergyResult[allergyInfo] as $allergies){
//        foreach($allergies as $Allergy => $flag){
////            print_r($Allergy);
////            echo nl2br ("\n");
////            print_r($flag);
////            echo nl2br ("\n");
//
////            for($i=0; $i<count($productClaims); $i++){
////                 print_r($claims);
////                 echo nl2br ("\n");
//
//             
//                //echo $Allergy."=>".$flag;
//                //echo nl2br ("\n");
//                if($flag == 0 && in_array('No '.$Allergy.' Ingredients', $productClaims)){
//                    $userAllergy = "Yes";
//                    
//                } else {
//                    $userAllergy = "No";
////                    break 2;
//                }
////            }
//        }
//        
//    }

  if (isset($_POST['searchBtn'])){
        // Running Request
        $runReq['type'] = 'fetchExcercise';
        $runReq["search_item"] = $productCalories.' calories Running';
        
        // Walking Request
        $walkReq['type'] = 'fetchExcercise';
        $walkReq["search_item"] = $productCalories.' calories Walking';
        
        //Bicycle Request
        $bicycleReq['type'] = 'fetchExcercise';
        $bicycleReq["search_item"] = $productCalories.' calories Bicycle';
        
        //Swimming Request
        $swimReq['type'] = 'fetchExcercise';
        $swimReq["search_item"] = $productCalories.' calories Swimming';
    }

    $runResults = createClientForDmz($runReq);
    $walkResults = createClientForDmz($walkReq);
    $bicycleResults = createClientForDmz($bicycleReq);
    $swimResults = createClientForDmz($swimReq);

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

  $getUserProd = array();
    $getUserProd["type"] = "getUserProduct";
    $getUserProd["email"] = $_SESSION['email'];
    $getUserProdResults = createClientForDb($getUserProd);
    
    $getUserProdParse = $getUserProdResults['userProductInfo'];
    for($i=0; $i < count($getUserProdParse); $i++){
        
        $getEachUserProd = $getUserProdParse[$i];

        $userFood = $getEachUserProd['food_name'];
        $userServingCount = $getEachUserProd['serving_count'];
        $userServingUnit = $getEachUserProd['serving_unit'];
        $userFoodCalories = $getEachUserProd['calories'];

    }

?>
