<?php

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');
    require_once('rabbitMQClient_DMZ.php');
    
    //error logging
    error_reporting(E_ALL);

    ini_set('display_error', 'Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', dirname(__FILE__).'/../logging/log.txt');
    
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--        <script type="text/javascript" src = "https://code.jquery.com/jquery-1.9.1.min.js"></script>-->

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>HomePage</title>
        <link rel="stylesheet" type="text/css" href="../css/homepage.css">
    </head>
    
    <style>
    
        
    </style>

    <body id = "wrapper">
        <nav class="navbar navbar-light bg-light">
            <?php  if (isset($_SESSION['email'])) : ?>
                <a class="navbar-brand">
                    <strong style="color:black;">Welcome, <?php echo $_SESSION['email']; ?></strong>
            </a>

            <form class="form-inline">
                <a class = "btn btn-info my-2 my-sm-0" href="../html/userAccount.php" style="margin:5px;">Account</a>
                <a id = "logoutBtn" class="btn btn-danger" href="logout.php?logout=true" style="margin:5px;">Logout</a>
            </form>
	       <?php endif ?>
        </nav>

        
        <div class="jumbotron text-center">
            <strong><h1 id = "searchHeader">Search Product</h1></strong>  
            <div class = "container">
                <form method="post" action="homepage.php">
                    <div class="input-group">
                        <input id = "searchBar" type="text" class="form-control mr-sm-3" name="searchBar" size="50" placeholder="Search for common food..."> 
                        
                        <input id = "searchUPC" type="text" class="form-control mr-sm-3" name="searchUPC" size="50" placeholder="Search with UPC...">
                        
                        <div class="input-group-btn">
                            <button id = "searchBtn" type="submit" class="btn btn-light" name="searchBtn">Search</button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
        
        <div class = "mainBody">
            <div class = "container">
                
                <div class="row">
                    <div class="col-sm-3">
                        <div id = "bmiCard" class="card mt-4">
                            <div class="card-body">
                                <strong><h4 style= "color:white;font-weight:bold;" class="card-title">BMI</h4></strong>
                                <p style= "color:white;font-weight:bold;font-size:20px;" class="card-text" name = "bmi"><?php echo $result." : ". $BMI_Category; ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        <div id = "calorieCard" class="card mt-4">
                            <div class="card-body">
                                <strong><h4 style= "color:white;font-weight:bold;" class="card-title">Total Calories</h4></strong>
                                <p class="card-text" style= "color:white;font-weight:bold;font-size:20px;"><?php echo $productCalories ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        <div id = "dailyCard" class="card mt-4">
                            <div class="card-body">
                                <strong><h4 style= "color:white;font-weight:bold;" class="card-title">Allergy to Product</h4></strong>
                                <p class="card-text"style= "color:white;font-weight:bold;font-size:20px;"></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        <div id = "dailyCard" class="card mt-4">
                            <div class="card-body">
                                <strong><h4 style= "color:white;font-weight:bold;" class="card-title">Day</h4></strong>
                                <p class="card-text"style= "color:white;font-weight:bold;font-size:20px;"><?php echo date("l") . ", " . date("m-d-y");?></p>
                            </div>
                        </div>
                    </div>
                </div><br>
                
                <div class="container">
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div id="panel" class="card mb-3" style="max-width: 540px;">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <center><?php echo '<img class="card-img-top" src = "'.$productPhoto.'">'?></center>
                                    </div>
                                </div>
                                
                                <div class="card-body">
                                    <b style="font-weigh:bold;color:red;"><h3 id ="foodName" class="card-title"><?php echo ucfirst($product_name);?></h3></b>

                                    <ul class="list-group list-group-flush">
                                        
                                        <b>Serving(s): </b><li id = "servingCount" class="list-group-item"><?php echo ucfirst($productServingCount);?></li>
                                        
                                        <b>Serving Unit: </b><li id = "servingUnit" class="list-group-item"><?php echo ucfirst($productServingUnit);?></li>
                                        
                                        <b>Serving Weight: </b><li class="list-group-item"><?php echo ucfirst($productServingWeight);?></li>
                                        <b> Total Fat: </b><li class="list-group-item"><?php echo ucfirst($productFat);?></li>
                                        
                                        <b>Calories: </b><li id = "calories" class="list-group-item"><?php echo ucfirst($productCalories);?></li>
                                        
                                        <b>Saturate Fat: </b><li class="list-group-item"><?php echo ucfirst($productSaturateFat);?></li>
                                        
                                        <b>Cholesterol: </b><li class="list-group-item"><?php echo ucfirst($productCholesterol);?></li>
                                        
                                        <b>Dietary Fiber: </b><li class="list-group-item"><?php echo ucfirst($productDietaryFiber);?></li>
                                        
                                        <b>Sugar: </b><li class="list-group-item"><?php echo ucfirst($productSugar);?></li>
                                        
                                        <b>Protein: </b><li class="list-group-item"><?php echo ucfirst($productProtin);?></li>
                                        
                                        <b>Potassium: </b><li class="list-group-item"><?php echo ucfirst($productPotassium);?></li>
                                    </ul>
                                    
                                    <br>
                                    <button type = "submit" id = "adding_product" name = "adding_product" onclick="addUserProduct()">Add</button>
                                </div>        
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            
                            <table class="table">
                              <thead class="thead-dark">
                                <tr>  
                                  <th scope="col">Exercise</th>
                                  <th scope="col">Duration</th>
                                  <th scope="col">Calories To Burn</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><b><?php echo ucfirst($runName) ?></b></td>
                                  <td><?php echo $runDuration ?></td>
                                  <td><?php echo $runCalories ?></td>
                                </tr>
                                  
                                <tr>
                                  <td><b><?php echo ucfirst($walkName) ?></b></td>
                                  <td><?php echo $walkDuration ?></td>
                                  <td><?php echo $walkCalories ?></td>
                                </tr>
                                  
                                <tr>
                                  <td><b><?php echo ucfirst($bicycleName) ?></b></td>
                                  <td><?php echo $bicycleDuration ?></td>
                                  <td><?php echo $bicycleCalories ?></td>
                                </tr>
                                  
                                <tr>
                                  <td><b><?php echo ucfirst($swimName) ?></b></td>
                                  <td><?php echo $swimDuration ?></td>
                                  <td><?php echo $swimCalories ?></td>
                                </tr>
                                
                              </tbody>
                            </table>
                            
                            <table class="table">
                              <thead class="thead-dark">
                                <tr>  
                                  <th scope="col">Food Name</th>
                                  <th scope="col">Serving Count</th>
                                  <th scope="col">Serving Unit</th>
                                  <th scope="col">Calories</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><b><?php echo ucfirst($userFood); ?></b></td>
                                  <td><?php echo ucfirst($userServingCount);?></td>
                                  <td><?php echo ucfirst($userServingUnit);?></td>
                                  <td><?php echo ucfirst($userFoodCalories);?></td>
                                </tr>
                              </tbody>
                            </table>
                            
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        
	<script>
            function addUserProduct(){
                
                var foodName = document.getElementById("foodName").textContent;
                var servingCount = document.getElementById("servingCount").textContent;
                var servingUnit = document.getElementById("servingUnit").textContent;
                var calories = document.getElementById("calories").textContent;
                var xhr;
                
                if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                    xhr = new XMLHttpRequest();
                } else if (window.ActiveXObject) { // IE 8 and older
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
                var data = "food_Name=" + window.encodeURIComponent(foodName) + "&serving_Count=" + window.encodeURIComponent(parseFloat(servingCount)) + "&serving_Unit=" + window.encodeURIComponent(servingUnit) + "&calories_Count=" + window.encodeURIComponent(parseFloat(calories));
                
//                var data = (foodName) + ", " + (servingCount) + ", " + (servingUnit) + ", " + (calories);

                xhr.open("POST", "addProduct.php", true); 
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
                xhr.send(data);
                xhr.onreadystatechange = display_data;
                
                function display_data(){
                    if(xhr.readyState == 4){
                        if(xhr.status == 200){
                            alert("Adding: " + data);
                        } else {
                            alert("There was a problem with the request.");
                        }
                    }
                }
            }
            
        </script>
        
                <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>

