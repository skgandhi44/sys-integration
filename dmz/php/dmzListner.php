<?php
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    
    //Error logging
    error_reporting(E_ALL);
    
    ini_set('display_errors', 'On');
    ini_set('log_errors', 'On');
    ini_set('error_log', dirname(__FILE__). '/../logging/log.txt');

function fetchItem($item){
	
	$curl = curl_init();
	
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://trackapi.nutritionix.com/v2/search/instant?query=".$item,
  		CURLOPT_RETURNTRANSFER => true,
  		CURLOPT_ENCODING => "",
  		CURLOPT_MAXREDIRS => 10,
  		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  		CURLOPT_CUSTOMREQUEST => "GET",
  		CURLOPT_HTTPHEADER => array(
    		        "Postman-Token: 8901c377-f138-4052-a142-4ab83e7f62be",
                    "cache-control: no-cache",
                    "x-app-id: 62fe602e",
                    "x-app-key: b374d3eba576afafbe1c0033f06a11cd"
  		    ),
        )
    );
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if($err) {
		echo "CURL ERROR #:".$err;
	}else{
        echo "Search Bar Entry = ".$item;
		$result = json_decode($response, true);
        $commonFoods = $result['common'];
        $food_details = $commonFoods['0'];
        print_r($food_details);
        return $food_details;
	}
}

function fetchNutrients($item){
	
	$curl = curl_init();
	
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://trackapi.nutritionix.com/v2/natural/nutrients",
  		CURLOPT_RETURNTRANSFER => true,
  		CURLOPT_ENCODING => "",
  		CURLOPT_MAXREDIRS => 10,
  		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  		CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => "",
  		CURLOPT_HTTPHEADER => array(
    		        "Postman-Token: 8901c377-f138-4052-a142-4ab83e7f62be",
                    "cache-control: no-cache",
                    "x-app-id: 62fe602e",
                    "x-app-key: b374d3eba576afafbe1c0033f06a11cd"
  		    ),
        )
    );
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if($err) {
		echo "CURL ERROR #:".$err;
	}else{
        echo "Search Bar Entry = ".$item;
		$result = json_decode($response, true);
        $commonFoods = $result['common'];
        $food_details = $commonFoods['0'];
        print_r($food_details);
        return $food_details;
	}
}


?>
