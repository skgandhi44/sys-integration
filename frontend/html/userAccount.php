<?php include('../php/validation.php');
    
    //Allergy Request
    $requestAllergy = array();
    $requestAllergy["type"] = "UserAllergy";
    $requestAllergy['email'] = $_SESSION['email'];
    $userAllergyResult = createClientForDb($requestAllergy);

    //Allergy Request
    $requestUserInfo = array();
    $requestUserInfo["type"] = "UserInfo";
    $requestUserInfo['email'] = $_SESSION['email'];
    $userInfoResult = createClientForDb($requestUserInfo);

    for ($i=0; $i<count($userInfoResult); $i++){
        $userInfoResultParse = $userInfoResult['userInfo'][$i];
        $userFlname = $userInfoResultParse['flname'];
        $userPhone = $userInfoResultParse['PhoneNumber'];
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

        <title>User Information</title>
        <link rel="stylesheet" type="text/css" href="">
    </head>
    
    <style>
        body{
            background-color: RGB(243,247,254);
        }
        
        .jumbotron{
            background-image: linear-gradient(-225deg, #FF3CAC 0%, #562B7C 52%, #2B86C5 100%);
            border-radius: 0 !important;
            height: 250px;
        }
        
        #page-header{
            margin-top: 50px;
            margin-bottom: 10px;
        }
        
        .card{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            margin: 0 auto;
        }
    </style>

    <body id = "wrapper">
       
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse btn-group" id="navbarSupportedContent">
                <div class="btn-group">
                    <a class="btn btn-primary" href="../php/homepage.php">Dashboard</a>
                </div>
            </div>
        </nav>
       
        <div class = "jumbotron">
            <header id = "page-header">
                <h2 class = "text-white text-center font-weight-bold">User Information</h2>
            </header>
        </div>

        <div class = "container">
            <div class="card x-shadow mx-auto" style="max-width: 550px; margin-top: -6rem;">
                <div class="card-body p-5">
                    <a>
                        Email: <strong><?php echo $_SESSION['email']; ?></strong><br>
                        Full Name: <strong><?php echo $userFlname;?></strong><br>
                        Phone Number: <strong><?php echo $userPhone; ?></strong><br>
                        Allergies: 
                        <strong>
                            <?php     
                                foreach($userAllergyResult[allergyInfo] as $allergies){
                                    foreach($allergies as $Allergy => $flag){
                                        if ($flag == 1){
                                           echo $Allergy.", ";
                                        }


                                    }
                                }
                            ; ?>
                        </strong><br>
                    </a>
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
