<?php

//    require_once('../rabbitmqphp_example/path.inc');
//    require_once('../rabbitmqphp_example/get_host_info.inc');
//    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
//    require_once('rabbitMQClient.php');
//    
//    
//    //logAndSendErrors();
//    session_start();
//    
//    if (!$_SESSION["logged"]){
//        header("Location: ../html/login.html");
//    }
//
//    $request = array();
//    $request['type'] = "UserProfile";
//    $request['email'] = $_SESSION["email"];
//    $data = createClientForDb($request);

    include('login.php');
    
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
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>

    <body id = "wrapper">

        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand">
                
            </a>

            <form class="form-inline">
                <a class="btn btn-danger" href="logout.php?logout=true" style="margin:5px;">Logout</a>
            </form>
        </nav>
                <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
