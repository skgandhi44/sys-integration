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
    
    session_start();

    if (!isset($_SESSION['email'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: ../html/login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['email']);
        header("location: ../html/login.php");
    }

    $APIreq = array();
    $searchBarResult = "";

    if (isset($_POST['searchBtn'])) {
        $APIreq['type'] = 'fetchItem';
        
        $productName = $_POST['searchBar'];
        $APIreq["search_item"] = $productName;
    }

    $APIresult = createClientForDmz($APIreq);

    $foodResultParse = $APIresult['food_name'];
    $productPhoto = $APIresult['photo']['thumb'];
    


    $request = array();
    $request["type"] = "UserBMI";
    $request['email'] = $_SESSION['email'];
    $result = createClientForDb($request);

    if($result <= 18.5){
        $BMI_Category = 'Underweight';
    }
    elseif ($result >= 18.5 and $result <= 24.9){
        $BMI_Category = 'Normal Weight';
    }
    elseif ($result >= 25 and $result <= 29.9){
        $BMI_Category = 'Over-Weight';
    }
    else {
        $BMI_Category = 'Obesity';
    }

?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>HomePage</title>
        <link rel="stylesheet" type="text/css" href="../css/homepage.css">
    </head>

    <body id = "wrapper">
        <nav class="navbar navbar-light bg-light">
            <?php  if (isset($_SESSION['email'])) : ?>
                <a class="navbar-brand">
                    <strong style="color:black;">Welcome, <?php echo $_SESSION['email']; ?></strong>
            </a>

            <form class="form-inline">
                <a id = "logoutBtn" class="btn btn-danger" href="logout.php?logout=true" style="margin:5px;">Logout</a>
            </form>
	<?php endif ?>
        </nav>

        
        <div class="jumbotron text-center">
            <strong><h1 id = "searchHeader">Search Product</h1></strong>  
            <div class = "container">
                <form method="post" action="homepage.php">
                    <div class="input-group">
                        <input id = "searchBar" type="text" class="form-control mr-sm-3" name="searchBar" size="50" placeholder="Search" required>
                        
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
                    <div class="col-sm-4">
                        <div id = "bmiCard" class="card mt-4">
                            <div class="card-body">
                                <strong><h4 style= "color:white;font-weight:bold;" class="card-title">BMI</h4></strong>
                                <p style= "color:white;font-weight:bold;font-size:27px;" class="card-text" name = "bmi"><?php echo $result." : ". $BMI_Category; ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div id = "calorieCard" class="card mt-4">
                            <div class="card-body">
                                <strong><h4 style= "color:white;font-weight:bold;" class="card-title">Calories</h4></strong>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div id = "dailyCard" class="card mt-4">
                            <div class="card-body">
                                <strong><h4 style= "color:white;font-weight:bold;" class="card-title">Day</h4></strong>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            </div>
                        </div>
                    </div>
                </div><br>
                
                <div class = "container">
                    <div class="card" style="width: 18rem;">
                        <?php echo '<img class="card-img-top" src = "'.$productPhoto.'">'?>
                        <div class="card-body">
                            <p class="card-text"><?php echo ucfirst($foodResultParse); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
                <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>

