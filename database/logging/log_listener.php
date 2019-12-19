<?php
   
    //Requried files
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');


    function storeError($error, $fileName){
        $fp = fopen( $fileName . '.txt', "a" );
        
        for ($i = 0; $i < count($error); $i++){
            fwrite( $fp, $error[$i] );
        }
        return true;
    }

    //This will route the request from server to function
    function requestProcessor($request){
       
        if(!isset($request['type'])){
            return array('message'=>"ERROR: Message type is not supported");
        }
        switch($request['type']){
               
            //  This case will handle all the requests from frontend   
            case "frontend":
                echo "<br>in Frontend listner: ";
                $response_msg = storeError($request['error_string'], 'frontend_errors');
                break;
               
            //  This case will handle all the requests from dmz
            case "dmz":
                
                echo "<br>In dmz listner: ";
                
                $response_msg = storeError($request['error_string'], 'dmz_errors');
                echo "Result: " . $response_msg;
                break;
         
            //  This case will handle all the requests from db
            case "db":
                
                echo "<br>In Database listner: ";
                
                $response_msg = storeError($request['error_string'], 'db_errors');
                echo "Result: " . $response_msg;
                break;
       
        }
        echo $response_msg;
        return $response_msg;
    }
    //creating a new server
    $FELogServer = new rabbitMQServer('../rabbitmqphp_example/rabbitMQ_RMQ.ini', 'FE_RMQ_Log_Server');

    $DMZLogServer = new rabbitMQServer('../rabbitmqphp_example/rabbitMQ_RMQ.ini', 'DMZ_RMQ_Log_Server');
   
    //processes the request sent by client
    $FELogServer->process_requests('requestProcessor');
    $DMZLogServer->process_requests('requestProcessor');

    ?>
