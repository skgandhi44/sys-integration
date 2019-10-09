<?php
    include('connection.php');
    session_start();

    // initializing variables
    $flname = $_SESSION["flname"];
    $email = $_SESSION["email"];
    $password_1 = $_SESSION["password_1"];

    $errors = array(); 


    // REGISTER USER
    if (isset($_POST['reg_user'])) {
        $flname = mysqli_real_escape_string($db, $_POST['flname']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
      // form validation: ensure that the form is correctly filled ...
      // by adding (array_push()) corresponding error unto $errors array
        
        if (empty($flname)) { 
            array_push($errors, "Full Name is required"); 
        } else {
            if (!preg_match("/^[a-zA-Z ]*$/", $flname)) {
                array_push($errors, "Only letters and white space allowed");
            }
        }
        
        if (empty($email)) { 
            array_push($errors, "Email is required"); 
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email address is invalid");
            }
        }
        
        if(!empty($email)){
            $user_check_query = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($db, $user_check_query);
            
            if (mysqli_num_rows($result) > 0) {
                array_push($errors, "Email already exists");
            }
        }
        
        if (empty($password_1)) { 
            array_push($errors, "Password is required"); 
        }
        if ($password_1 != $password_2) {
            array_push($errors, "The two passwords do not match");
        }
      // Finally, register user if there are no errors in the form
      if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database
        $query = "INSERT INTO users (fullname, email, password) VALUES('$flname', '$email', '$password')";
        mysqli_query($db, $query) or die (mysqli_error ($db));
        $_SESSION['email'] = $email;
          
        $_SESSION['flname'] = $flname;
        $user = "SELECT * FROM users WHERE fullname='$flname'";
        header('location: index.php');
      }
    }

//////////////// Login Page user Login //////////////////////
    if (isset($_POST['login_user'])) {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        
        if (empty($password)) {
            array_push($errors, "Password is required");
        }
        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $results = mysqli_query($db, $query) or die (mysqli_error ($db));;
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['email'] = $email;
                header('location: index.php');
            } else {
                array_push($errors, "Wrong username/password combination");
            }
        }
    }
?>
