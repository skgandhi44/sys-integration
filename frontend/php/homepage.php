<?php

    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');
    
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
        
    $request = array();
    $search = $_POST['searchBar'];
    $request["type"] = "fetchItem";

    $request["search_item"] = $search;
    $result = createClientForDb($request);
    echo $result;

    
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
'
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>HomePage</title>
<!--        <link rel="stylesheet" type="text/css" href="../css/style.css">-->
    </head>
    
    <style>
        
        .jumbotron{
            background-color:  #760be1;
            border-radius: 0 !important;
        }

        #searchBar{
            border-radius: 0 !important;
        }
        
        #searchBtn{
            border-radius: 0 !important;
        }
        
        #loginBtn{
            
        }
        
        #searchHeader{
            color: white;
            margin-bottom: 25px;
        }
        
    </style>


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
                            <button id = "searchBtn" type="button" class="btn btn-light" name="searchBtn">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
                <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
