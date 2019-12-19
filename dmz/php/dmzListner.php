<?php
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc'); 
    include('dmzFunctions.php');

    //Error logging
    error_reporting(E_ALL);
    
    ini_set('display_errors', 'On');
    ini_set('log_errors', 'On');
    ini_set('error_log', dirname(__FILE__). '/../logging/log.txt');

    function requestProcessor($request)
    {
            //echo "received request".PHP_EOL;
    //        if($request['type']){
    //            echo "<br> type = " . $request['type'];
    //        }


            //var_dump($request);

            if(!isset($request['type']))
            {
                return "";
            }

            echo "received request".PHP_EOL;
              switch ($request['type'])
              {
                  case "fetchUPC":
                      echo "Search UPC Product Case";
                      $response = fetchUPC($request['search_item']);
                      break;

                  case "fetchNutrients":
                      echo "Search Food Nutrients Case";
                      $response = fetchNutrients($request['search_item']);
                      break;

                  case "fetchExcercise":
                      echo "Search Exercise Case";
                      $response = fetchExercise($request['search_item']);
                      break;
                      
                  case "SMS":
                      echo "Send SMS Case";
                      $response = sendSMS($request['PhoneNumber'], $request['calories']);
                      break;

              }
                //echo $response;
                return $response;
            }
            $server = new rabbitMQServer("../rabbitmqphp_example/testRabbitMQ.ini","testServer");
            //echo "testRabbitMQServer BEGIN".PHP_EOL;
            $server->process_requests('requestProcessor');
            //exit();
?>
