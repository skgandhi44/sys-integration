<?php

    session_start();

    
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    
    
    // Adding User Link
    $removeProductToList = array();
    $removeProductToList["type"] = "removeUserProduct";
    $removeProductToList["email"] = $_SESSION['email'];

    $removeProductToList["food_name"] = $_POST['food_Name'];
    $removeProductToList["serving_count"] = $_POST['serving_Count'];
    $removeProductToList["serving_unit"] = $_POST['serving_Unit'];
    $removeProductToList["calories"] = $_POST['calories_Count'];
    $removeProductToList["date"] = $_POST['time_ate'];

    var_dump($addingProductToList);

//    $removeProductResult = createClientForDb($removeProductToList);

?>
