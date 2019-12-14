<?php

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');
    require_once('rabbitMQClient_DMZ.php');
    include("../php/homepagerequest.php");
    
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      
    <link href="../css/homepage.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Alatsi&display=swap" rel="stylesheet">

    <title>Nutrisize</title>
      
      <style>
          
          .border-left-orange{border-left:.25rem solid rgb(239,122,28) !important}
          .border-left-red{border-left:.25rem solid rgb(222,79,84) !important}
          .border-left-brown{border-left:.25rem solid rgb(186,87,83) !important}
          
          .text-orange{color: rgb(239,122,28);}
          .text-red{color: rgb(222,79,84);}
          .text-brown{color: rgb(186,87,83);}
          
          html, body {
             height:100%;
             padding:0;
             margin:0;
            }
          
      </style>
      
  </head>
    
    <body>

        <nav class="navbar navbar-expand navbar-light bg-white topbar md-4 static-top shadow">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="background-color:black;"></span>
            </button>
            <h3 style="font-family: 'Alatsi', sans-serif; color: #ff185e ">NutriSize</h3>
            
            <div class = "mr-auto"></div>
            
            <ul class="navbar-nav">
                <div class="topbar-divider d-none d-sm-block"></div>
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <?php  if (isset($_SESSION['email'])) : ?>
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['email']; ?></span>
                    </a>
                
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="../html/userAccount.php">Account</a>

                        <a class="dropdown-item" href="logout.php?logout=true">Logout</a>
                    </div>
                    <?php endif ?>
                </li>
            </ul>
        </nav>
        
        <br>
    
        <div class = "container">
            <form method="post" action="homepage.php">
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <input id = "searchBar" type="text" class="form-control input-lg" name="searchBar"  placeholder="Search for common food..."> 
                    </div>
                    
                    <div class="form-group col-md-5">
                        <input id = "searchUPC" type="text" class="form-control input-lg" name="searchUPC"  placeholder="Search with UPC...">
                    </div>

                    <div class="form-group col-md-2">
                        <button id = "searchBtn" type="submit" class="btn btn-primary" name="searchBtn" style="border-radius:2px;">Search</button>
                    </div>
                </div>
            </form>
        </div>
        
        <br>
      
        <div class="container-fluid" class = "mainBody">
            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div id = "bmiCard" class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-md font-weight-bold text-warning text-uppercase mb-1">BMI</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" name = "bmi"><?php echo $result." : ". $BMI_Category; ?></div>
                                </div>
                                
                                <div class="col-auto">
                                    <img src="../image/bmi.png" style="width:75px; hight:75px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-md-6 mb-4">
                    <div id = "calorieCard" class="card border-left-orange shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-md font-weight-bold text-orange text-uppercase mb-1">Total Calories</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $getTotalCaloriesResults; ?></div>
                                </div>
                                
                                <div class="col-auto">
                                    <img src="../image/calories.jpg" style="width:75px; hight:75px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-md-6 mb-4">
                    <div id = "dailyCard" class="card border-left-brown shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-md font-weight-bold text-brown text-uppercase mb-1">Today Is</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo date("l") . ", " . date("m-d-y");?></div>
                                </div>
                                
                                <div class="col-auto">
                                    <img src="../image/date.png" style="width:75px; hight:75px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
            
            <div class="d-md-flex">
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Nutrition Facts</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <?php echo '<img class="card-img-top" src = "'.$productPhoto.'">'?>
                                
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
                                <button type = "submit" id = "adding_product" name = "adding_product" class="btn btn-success" onclick="addUserProduct()">Add</button>
                        </div>
                    </div>
                </div>

                <!-- Second Half -->

                <div class="col-md-8 p-0 h-md-100">
                    <div class="d-md-flex">
                        <div class="col-xl-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Just Ate</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body table-responsive">
                                    <table class="table">
                                      <thead class="thead-dark">
                                        <tr>  
                                          <th scope="col">Food Name</th>
                                          <th scope="col">Serving Count</th>
                                          <th scope="col">Serving Unit</th>
                                          <th scope="col">Calories</th>
                                          <th scope="col">Time</th>
                                          <th scope="col"></th>
                                        </tr>
                                      </thead>

                                      <tbody>
                                          <?php 
                                                if($getUserProdParse != "No Product Added Today!"){
                                                    for($i=0; $i < count($getUserProdParse); $i++){

                                          ?>
                                            <tr id="row1">
                                                
                                              <td id="food_name_ate"><b><?php echo ucfirst($getUserProdParse[$i]["food_name"]); ?></b></td>
                                              <td id="serving_count_ate"><?php echo ucfirst($getUserProdParse[$i]["serving_count"]);?></td>
                                              <td id="serving_unit_ate"><?php echo ucfirst($getUserProdParse[$i]["serving_unit"]);?></td>
                                              <td id="calories_ate"><?php echo ucfirst($getUserProdParse[$i]["calories"]);?></td>
                                              <td id="time_ate"><?php echo ucfirst($getUserProdParse[$i]["date"]);?></td>
                                                
                                              <td><button type="submit" class="btn btn-outline-danger remove" onclick="removeUserProduct()">Remove</button></td>
                                            </tr>
                                          <?php     }
                                                }
                                                else {
                                            ?>
                                            
                                            <h5><?php echo ucfirst($getUserProdParse); ?></h5>
                                                  
                                        <?php } ?>
                                      </tbody>           
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-md-flex">
                        <div class="col-xl-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Just Burn It</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <table class="table">
                                      <thead class="thead-dark">
                                        <tr>  
                                          <th scope="col">Exercise</th>
                                          <th scope="col">Duration</th>
                                          <th scope="col">Calories To Burn</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          <?php
                                            if($getUserProdParse != "No Product Added Today!"){
                                          ?>
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
                                          <?php
                                            }
                                          else{
                                        ?>
                                              <h5><?php echo "No food, no excercise!"; ?></h5>
                                         <?php 
                                            }
                                          ?>
                                      </tbody>
                                    </table>
                                </div>
                            </div>
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
                //var time_ate = document.getElementById("time_ate").textContent;
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
                            alert("Added to list");
                            location.reload();
                        } else {
                            alert("There was a problem with the request.");
                        }
                    }
                }
            }
            
            $(".remove").click(function(){
                var trId = $(this).parents("tr").attr("id");
                
                if(confirm('Are you sure to remoe this record?')){
                    $.ajax({
                        url: '../php/removeProduct.php',
                        type: 'GET',
                        data: {id: id},
                        error: function(){
                            alert('Something Went Wrong');
                        },
                        
                        success: function(data){
                            $(data).remove();
                            alert("Record remove successfully");
                        }
                    });
                }
            });
            
//            function removeUserProduct(){
//                
//                //var remove = document.getElementById("row1").remove();
//                
//                var foodName = document.getElementById("food_name_ate").textContent;
//                var servingCount = document.getElementById("serving_count_ate").textContent;
//                var servingUnit = document.getElementById("serving_unit_ate").textContent;
//                var calories = document.getElementById("calories_ate").textContent;
//                var time_ate = document.getElementById("time_ate").textContent;
//                var xhr;
//                
//                if (window.XMLHttpRequest) { // Mozilla, Safari, ...
//                    xhr = new XMLHttpRequest();
//                } else if (window.ActiveXObject) { // IE 8 and older
//                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
//                }
//                var data = "food_Name=" + window.encodeURIComponent(foodName) + "&serving_Count=" + window.encodeURIComponent(parseFloat(servingCount)) + "&serving_Unit=" + window.encodeURIComponent(servingUnit) + "&calories_Count=" + window.encodeURIComponent(parseFloat(calories)) + "&time_ate=" + window.encodeURIComponent(time_ate);
//
//                xhr.open("POST", "removeProduct.php", true); 
//                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
//                xhr.send(data);
//                xhr.onreadystatechange = display_data;
//                
//                function display_data(){
//                    if(xhr.readyState == 4){
//                        if(xhr.status == 200){
//                            alert("Data: " + data);
////                            location.reload(true);
//                        } else {
//                            alert("There was a problem with the request.");
//                        }
//                    }
//                }
//            }
            
        </script>
        
    <footer>
        
    </footer>
      
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
