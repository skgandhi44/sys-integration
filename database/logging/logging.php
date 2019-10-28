<?php

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');

    //Error logging
    //Cron job every 5 mins: * /5 * * * root logging.php

    $file = fopen("../logging/log.txt","r");
    $errorArray = [];
    while(! feof($file)){
        array_push($errorArray, fgets($file));
    }
    
    fclose($file);

    //RMQ request
    $request = array();
    $request['type'] = "db";  
    $request['error_string'] = $errorArray;
    $returnedValue = createClientForRmq($request);
    $fp = fopen("../logging/log_history.txt", "a");

    for($i = 0; $i < count($errorArray); $i++){
        fwrite($fp, $errorArray[$i]);
    }

    file_put_contents("../logging/log.txt", "");

    function createClientForRmq($request){
        $client = new rabbitMQClient("../rabbitmqphp_example/rabbitMQ_rmq.ini", "testServer");
       
        if(isset($argv[1])){
            
            $msg = $argv[1];
        }
        else{
            $msg = "client";
        }
        $response = $client->send_request($request);
        return $response;
    }

    
    
?>