<?php 
    include('../php/validation.php');

    if (!isset($_SESSION['email'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
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

        <title>User Profile</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    
    <body id = "wrapper">

        <div class = "jumbotron">
            <header id = "page-header">
                <h2 class = "text-white text-center font-weight-bold">Allergy Survey</h2>
            </header>
        </div>

        <div class = "container">
            <div class="card x-shadow mx-auto" style="max-width: 500px; margin-top: -7rem;">
                <div class="card-body p-5">

                    <form method="post" action="profile.php">
                        <strong><p>1) Do you have an Allergy? Please select all that apply.</p></strong>
                       
                        <div class = "question" onclick="appear()">
                            <div id="checkbox">
                                <input id = "option" type="checkbox" name="A1" >  Egg<br>
                                <input id = "option" type="checkbox" name="A2" >  Soy<br>
                                <input id = "option" type="checkbox" name="A3" >  Milk<br>
                                <input id = "option" type="checkbox" name="A4" >  Peanuts<br>
                                <input id = "option" type="checkbox" name="A5" >  Shellfish<br>
                                <input id = "option" type="checkbox" name="A6" >  Wheat<br>
                                <input id = "option" type="checkbox" name="A7" >  Gluten<br>
                                <input id = "option" type="checkbox" name="A8" >  Tree nuts<br>
                                <input id = "option" type="checkbox" name="A9" >  Fish    

                            </div>
                        </div>
                        <br>
                        <div class="text-left">
                            <button class="btn btn-primary" type="submit" name="user_allergy" value="Save">Submit</button>
                        </div>
                    </form>
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
