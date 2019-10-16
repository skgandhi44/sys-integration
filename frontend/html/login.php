<?php include('../php/validation.php');?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>

    <body id = "wrapper">

        <div class = "jumbotron">
            <header id = "page-header">
                <h2 class = "text-white text-center font-weight-bold">Sign in to your account</h2>
            </header>
        </div>

        <div class = "container">
            <div class="card x-shadow mx-auto" style="max-width: 400px; margin-top: -7rem;">
                <div class="card-body p-5">

                    <form method="post" action="login.php">

			<?php include('../php/errors.php');?>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control input-lg" Placeholder="Email" value="<?php echo $email?>">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control input-lg" Placeholder="Password">
                        </div>

                        <div class="text-left">
                            <button class="btn btn-primary" type="submit" name="login_user">Login</button>
                        </div>
                        
                        <br>
                        <div class="text-left">
                            <a id = "registerButton" href="register.php" style="color:blue;">Not Yet a Member?</a>
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
