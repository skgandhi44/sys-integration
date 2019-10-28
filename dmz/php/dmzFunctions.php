<?php
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    


function fetchItem($item){
	
	$curl = curl_init();
	
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.nutritionix.com/v1_1/search/'.$item.'?results=0:20&fields=item_name,brand_name,item_id,nf_calories,nf_protein,nf_sugars,nf_sodium&appId=62fe602e&appKey=b374d3eba576afafbe1c0033f06a11cd",
  		CURLOPT_RETURNTRANSFER => true,
  		CURLOPT_ENCODING => "",
  		CURLOPT_MAXREDIRS => 10,
  		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  		CURLOPT_CUSTOMREQUEST => "GET",
  		CURLOPT_HTTPHEADER => array(
    		  //"Postman-Token: eb158d0e-a543-4895-8d47-e4e0f967be96",
                "cache-control: no-cache"
  		    ),
        )
    );
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if($err) {
		echo "CURL ERROR #:".$err;
	}else{
		//echo $response;
		$result = json_decode($response, true);
		$hits = $result['hits'];
		$item_info = $hits['0'];
		print_r($item_info);
		return $item_info;	
	}
}


?>
