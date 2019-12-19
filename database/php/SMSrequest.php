<?php
    
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');
    include('connection.php');


    $connection = connection();


    //Query to get the Emails
    $check_user_info = "SELECT DISTINCT email, PhoneNumber FROM users";
    $check_result = $connection->query($check_user_info);

    while($row = $check_result->fetch_assoc()){
        $emailAddress = $row['email'];
        $PhoneNumber = $row["PhoneNumber"];
                
        $userInfo[] = array('email'=>$emailAddress, 'PhoneNumber'=>$PhoneNumber);
    }   

    for ($i = 0; $i < count($userInfo); $i++){
        $userInfoParse = $userInfo[$i];
        $email = $userInfoParse['email'];
        $PhNumber = $userInfoParse['PhoneNumber'];
    

        $connection = connection();

        $check_user_calories = "SELECT sum(calories) as TotalCalories FROM user_product_list WHERE email = '$email' and cast(date AS DATE) = current_date()";

        $check_calories_result = $connection->query($check_user_calories);

        $obj2 = $check_calories_result->fetch_assoc();

        $Calories = $obj2["TotalCalories"];

        if (!isset($Calories)){
            $Calories = "zero";
            $request['type'] = "SMS";
            $request['PhoneNumber'] = $PhNumber;   
            $request['calories'] = $Calories;   

        }
        else{

            $request['type'] = "SMS";
            $request['PhoneNumber'] = $PhNumber;   
            $request['calories'] = $Calories;   

        }


        var_dump($request);
        $results = createClientForDb($request);

        echo $results;
    }

?>