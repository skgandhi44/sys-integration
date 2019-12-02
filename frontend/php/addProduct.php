<?php

    session_start();

    
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');
    require_once('rabbitMQClient_DMZ.php');
    
    
    // Adding User Link
    $addingProductToList = array();
    $addingProductToList["type"] = "addUserProduct";
    $addingProductToList["email"] = $_SESSION['email'];

    $addingProductToList["food_name"] = $_POST['food_Name'];
    $addingProductToList["serving_count"] = $_POST['serving_Count'];
    $addingProductToList["serving_unit"] = $_POST['serving_Unit'];
    $addingProductToList["calories"] = $_POST['calories_Count'];

    // var_dump($addingProductToList);

   $addProductResult = createClientForDb($addingProductToList);

?>
