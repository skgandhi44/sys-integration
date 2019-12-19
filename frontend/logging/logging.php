<?php
    //  Error logging
    //Cron job every 5 mins: * /5 * * * root logging.php
    error_reporting(E_ALL);
    
    ini_set('display_errors', 'On');
    ini_set('log_errors', 'On');
    
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');

    $file = fopen("../logging/log.txt","r");
    $errorArray = [];
    while(! feof($file)){
        array_push($errorArray, fgets($file));
    }
    
    fclose($file);
    
    //RMQ request    
    $request = array();
    $request['type'] = "frontend";  
    $request['error_string'] = $errorArray; 
    $returnedValueToDMZ = createClientForDMZ($request);
    $returnedValueToDB = createClientForDB($request);
    $fp = fopen("../logging/log_history.txt", "a");
    
    for($i = 0; $i < count($errorArray); $i++){
        fwrite($fp, $errorArray[$i]);
    }

    file_put_contents("../logging/log.txt", "");

    function createClientForDMZ($request){
            $client = new rabbitMQClient("../rabbitmqphp_example/rabbitMQ_RMQ.ini", "FE1_RMQ_LOG_Server");
            if(isset($argv[1])){
                $msg = $argv[1];
            }
            else{
                $msg = "client";
            }
            $response = $client->send_request($request);
            return $response;
        }

    function createClientForDB($request){
            $client = new rabbitMQClient("../rabbitmqphp_example/rabbitMQ_RMQ.ini", "FE2_RMQ_LOG_Server");
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
