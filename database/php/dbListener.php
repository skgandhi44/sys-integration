<?php

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc'); 

    include('dbServer.php');

    function requestProcessor($request)
    {
        echo "received request".PHP_EOL;
        echo "<br> type = " . $request['type'];
        echo "<br> email = " . $request["email"];
        echo "<br> pass = " . $request["pass"];
        //var_dump($request);
        

      if(!isset($request['type']))
      {
        return "ERROR: unsupported message type";
      }
        
      switch ($request['type'])
      {
          case "login":
              echo "Login Case";
              $response = login($request['email'],$request['pass']);
              break;
          
          case "register":
              echo "Register Case";
              $response = register($request['flname'],$request['email'],$request['pass']);
              break;
      }
        echo $response;
        return $response;
    }

    $server = new rabbitMQServer("../rabbitmqphp_example/testRabbitMQ.ini","testServer");

    //echo "testRabbitMQServer BEGIN".PHP_EOL;
    $server->process_requests('requestProcessor');
    //exit();
?>