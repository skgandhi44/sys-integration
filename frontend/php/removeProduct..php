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
    $removeProductToList["date"] = $_POST['time_ate'];

    $removeProductResult = createClientForDb($removeProductToList);

?>
