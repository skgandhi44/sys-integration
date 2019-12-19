<?php
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    //require_once('../rabbitmqphp_example/rabbitMQClient.php');
    include('connection.php');
    
    //Error logging
    error_reporting(E_ALL);
    
    ini_set('display_errors', 'On');
    ini_set('log_errors', 'On');
    ini_set('error_log', dirname(__FILE__). '/../logging/log.txt');


    function login($email, $password){
        $connection = connection();
        $password_hash = md5($password);
        $s = "select * from users where email='$email' and password='$password_hash'";
        $result = mysqli_query($connection, $s) OR die(mysqli_error($connection));
        $num = mysqli_num_rows($result);
        if ($num > 0){
            $userEmail = $_SESSION["email"] = $email;
            //header('location: ../php/homepage.php');
            echo "Login successful: return value ";
            return true;
        } else {
            //header('location: ../php/login.php');
            echo "Login failed";
            return false;
        }
    }
    // This function registers a new user 
    function register($flname, $email, $password, $heightInInches, $weightInPound, $PhoneNumber){
        //Makes connection to database
        $connection = connection();
        //Hashes password
        $password_hash = md5($password);
        
        $UserBMI = (703 * ($weightInPound / pow($heightInInches, 2)));
        
        //Query for a new user
        $newuser_query = "INSERT INTO users (flname, email, password, heightInInches, weightInPound, UserBMI, PhoneNumber) VALUES ('$flname', '$email', '$password_hash', '$heightInInches', '$weightInPound', '$UserBMI', '$PhoneNumber')";
        
        $resultInsert = mysqli_query($connection, $newuser_query) OR die(mysqli_error($connection));
        //$numResult = mysqli_num_rows($resultInsert);
        
        if ($resultInsert == 1){
            $userEmail = $_SESSION["email"] = $email;
            return true;
        } else {
            return false;
        }
        
    }
    // This function checks if email is valid
    function checkEmail($email){
        $connection = connection();
        
        //Query to check if the email is email
        $check_email = "SELECT * FROM users WHERE email = '$email'";
        $check_result = $connection->query($check_email);
        
        if($check_result){
            if($check_result->num_rows == 0){
                return true;
            } elseif($check_result->num_rows == 1){
                return false;
            }
        }
    }

    function userInfo($email){
        $connection = connection();
        
        //Query to check if the email is email
        $check_email = "SELECT * FROM users WHERE email = '$email'";
        $check_result = $connection->query($check_email);
        
        while($row = $check_result->fetch_assoc()){
            $fName = $row['flname'];
            $PhoneNumber = $row['PhoneNumber'];

            
            $userInfo[] = array('flname'=>$fName, 'PhoneNumber'=>$PhoneNumber);
        }   


            
        $allUserInfo = [];

        $allUserInfo = array('userInfo'=>$userInfo);

        return $allUserInfo; 

    }

    function UserBMI($email){
        $connection = connection();
        
        //Query to get the BMI info
        $check_BMI = "SELECT UserBMI FROM users WHERE email = '$email'";
        $check_result = $connection->query($check_BMI);
        
//        echo $check_BMI . " ";
        $obj = $check_result->fetch_assoc();
           
        $BMI = $obj["UserBMI"];
        return $BMI;
            
            
    }

    function allergy($email, $egg, $soy, $milk, $peanuts, $shellfish, $wheat, $gluten, $treenut, $fish)
    {
        //Makes connection to database
        $connection = connection();
    
        
        //Query for a new user
        $newuser_query = "INSERT INTO allergy
                            (
                                `Email`,
                                `Egg`,
                                `Soy`,
                                `Milk`,
                                `Peanuts`,
                                `Shellfish`,
                                `Wheat`,
                                `Gluten`,
                                `Treenut`,
                                `Fish`
                            )
                            VALUES('$email','$egg','$soy','$milk','$peanuts','$shellfish','$wheat','$gluten','$treenut','$fish')";
        
        $resultInsert = mysqli_query($connection, $newuser_query) OR die(mysqli_error());
        //$numResult = mysqli_num_rows($resultInsert);
        
        if ($resultInsert == 1){
//            $userEmail = $_SESSION["email"] = $email;
            return true;
        } else {
            return false;
        }
        
    }

    function getAllergy($email){
        $connection = connection();
        
        //Query to get the BMI info
        $check_allergy = "SELECT Egg, Soy, Milk, Peanuts, Shellfish, Wheat, Gluten, Treenut, Fish FROM allergy WHERE email = '$email'";
        $check_result = $connection->query($check_allergy);
        
        while($row = $check_result->fetch_assoc()){
            $egg = $row['Egg'];
            $Soy = $row['Soy'];
            $Milk = $row['Milk'];
            $Peanuts = $row['Peanuts'];
            $Shellfish = $row['Shellfish'];
            $Wheat = $row['Wheat'];
            $Gluten = $row['Gluten'];
            $Treenut = $row['Treenut'];
            $Fish = $row['Fish'];        
            $allergyInfo[] = array('Egg'=>$egg, 'Soy'=>$Soy, 'Milk'=>$Milk, 'Peanuts'=>$Peanuts, 'Shellfish'=>$Shellfish, 'Wheat'=>$Wheat, 'Gluten'=>$Gluten, 'Treenut'=>$Treenut, 'Fish'=>$Fish);
        }   
//        for($i=0; i<count($obj); $i++){
//            $egg = $obj["Egg"];
//        }

//        echo json_decode($obj);
        $allinfo = [];
        
        $allinfo = array('allergyInfo'=>$allergyInfo);
        
        return $allinfo; 
            
    }

    function addUserProduct($email, $food_name, $serving_count, $serving_unit, $calories){
        
        //Makes connection to database
        $connection = connection();
        
        echo $serving_count;
        //Query for a new user
        $new_food_query = "INSERT INTO user_product_list (email, food_name, serving_count, serving_unit, calories) VALUES ('$email', '$food_name', '$serving_count', '$serving_unit', '$calories')";
        
        $resultInsert = mysqli_query($connection, $new_food_query) OR die(mysqli_error($connection));
        //$numResult = mysqli_num_rows($resultInsert);
        
        if ($resultInsert == 1){
            echo "User added ".$food_name;
            echo nl2br ("\n");
            return true;
            
        } else {
            return false;
        }
        
    }

    function removeUserProduct($email, $date, $food_name
                               //, $serving_count, $serving_unit, $calories
                              ){
        
        //Makes connection to database
        $connection = connection();
        
        $day = date("y-m-d");
        //Query for a new user
        $new_food_query = "DELETE FROM user_product_list WHERE email='$email' AND date='" . $day . " ". $date . "'AND food_name='$food_name'";
        
        //AND food_name='$food_name' AND serving_count='$serving_count' AND serving_unit='$serving_unit' AND calories='$calories'
        
        $resultInsert = mysqli_query($connection, $new_food_query) OR die(mysqli_error($connection));
        //$numResult = mysqli_num_rows($resultInsert);
        
        if ($resultInsert == 1){
            echo "User removed ".$food_name;
            echo nl2br ("\n");
            return true;
            
        } else {
            return false;
        }
        
    }

    function getUserProducts($email){
        $connection = connection();
        
        //Query to get the BMI info
        $check_user_product = "SELECT cast(date as TIME) AS date, food_name, serving_count, serving_unit, calories FROM user_product_list WHERE email = '$email' and cast(date AS DATE) = current_date()";
        $check_result = $connection->query($check_user_product);
        
        while($row = $check_result->fetch_assoc()){
            $date = $row['date'];
            $food_name = $row['food_name'];
            $serving_count = $row['serving_count'];
            $serving_unit = $row['serving_unit'];
            $calories = $row['calories'];
            
            $userProductInfo[] = array('date'=>$date, 'food_name'=>$food_name, 'serving_count'=>$serving_count, 'serving_unit'=>$serving_unit, 'calories'=>$calories);
        }   

        if (isset($userProductInfo)){
            
            $allUserProcuctsInfo = [];
        
            $allUserProcuctsInfo = array('userProductInfo'=>$userProductInfo);

            return $allUserProcuctsInfo; 
        }
        else {
            $allUserProcuctsInfo = [];
        
            $allUserProcuctsInfo = array('userProductInfo'=>"No Product Added Today!");
            
            return $allUserProcuctsInfo;
        }

            
    }

    function getTotalCalories($email){
        $connection = connection();
        
        //Query to get the BMI info
        $check_total_cal = "SELECT sum(calories) as TotalCalories FROM user_product_list WHERE email = '$email' and cast(date AS DATE) = current_date()";
        $check_result = $connection->query($check_total_cal);
        
        $obj = $check_result->fetch_assoc();
           
        $TotalCalories = $obj["TotalCalories"];
        
        if (!isset($TotalCalories)){
            $TotalCalories = "You did not eat anything today!";
            return $TotalCalories;
        }
        else{
            return $TotalCalories; 
        }
            
    }

?>
