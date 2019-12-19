<?php
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    
    //Error logging
    error_reporting(E_ALL);
    
    ini_set('display_errors', 'On');
    ini_set('log_errors', 'On');
    ini_set('error_log', dirname(__FILE__). '/../logging/log.txt');

function fetchUPC($item){
	
	$curl = curl_init();
	
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://trackapi.nutritionix.com/v2/search/item?upc=".$item."&claims=true",
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
        //print_r($result);
        return $result;
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
      CURLOPT_POSTFIELDS => "query=".$item,
      CURLOPT_HTTPHEADER => array(
            "Postman-Token: d278d0a7-d9b0-4390-833b-e5d017b71730",
            "cache-control: no-cache",
            "x-app-id: 62fe602e",
            "x-app-key: b374d3eba576afafbe1c0033f06a11cd",
            "x-remote-user-id: 0"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
        echo "Search Bar Entry = ".$item;
		$result = json_decode($response, true);
        //print_r($result);
        return $result;
    }

}

function fetchExercise($exercise){
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://trackapi.nutritionix.com/v2/natural/exercise",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "query=".$exercise,
      CURLOPT_HTTPHEADER => array(
            "Postman-Token: d278d0a7-d9b0-4390-833b-e5d017b71730",
            "cache-control: no-cache",
            "x-app-id: 62fe602e",
            "x-app-key: b374d3eba576afafbe1c0033f06a11cd",
            "x-remote-user-id: 0"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
        echo "Search Bar Entry = ".$exercise;
		$result = json_decode($response, true);
        //print_r($result);
        return $result;
    }

}

function sendSMS($PhoneNumber, $calories){
    
    $ch = curl_init('https://textbelt.com/text');
    $data = array(
      'phone' => $PhoneNumber,
      'message' => 'Today you consumed '.$calories.' calories!',
      'key' => 'NutriSize',
    );

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);
    
    return "Message sent to ". $PhoneNumber;
    
}
?>
