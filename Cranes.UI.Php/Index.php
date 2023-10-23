<?php
session_start();

$applicationName = "Hijaz Crane Service";
$table = "Employee";
include "./MySql/Includes/dbh.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    
    <!-- Favicons -->
    <meta name="theme-color" content="#7952b3">
    <link rel="icon" href="./favicon.jpg">
    <?php $table = "Login"; include("Content/Head.php"); ?>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="./Content/signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <main class="form-signin">
        <form method="POST">
            <img class="mb-4" src="favicon.jpg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="login-btn">Sign in</button>
            <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
        </form>
        <?php 
        if(isset($_POST['login-btn'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $query = "SELECT Email, Password FROM employees WHERE Email = '$email' and Password = '$password'";
            $employee = mysqli_query($con, $query);
            if(mysqli_num_rows($employee) > 0){
                $user = mysqli_fetch_array($employee);
                $_SESSION['Email'] = $user['Email'];
                echo "<script> window.location = 'Home.php' </script>";
            }
            else{
                echo "<h2 class='btn btn-danger'>Invalid User Name or Password</h2>";
            }
        }
        ?>
    </main>
</body>
</html>