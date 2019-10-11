<?php

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    $flname = $_POST["flname"];
    $email = $_POST["email"];
    $pass = $_POST["password"];

    $request = array();

    $request["type"] = "register";
    $request["flname"] = $flname;
    $request["email"] = $email;
    $request["pass"] = $pass;

    $result = createClientForDb($request);
    echo $result;


?>
