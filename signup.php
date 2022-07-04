<?php
//  session_start();
include ("connection.php");
include ("function.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $orders = 0;
    if(!empty($username) && !empty($password) && !is_numeric($username)) {
        $user_id = random_num(20);
        $query = "INSERT INTO `user` (`user_id`, `name`, `email`, `username`, `password`, `orders`) VALUES ('$user_id', '$name', '$email', '$username', '$password', '$orders');";
        mysqli_query($con, $query);
        header("Location: login.php");
        die;
    }
    else{
        echo "please enter valid information";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Signin To Sheba</title>

    <!--    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sign-in/">-->

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Favicons -->
    <!--    <link rel="apple-touch-icon" href="images/apple-touch-icon.png" sizes="180x180">-->
    <!--    <link rel="icon" href="images/favicon-32x32.png" sizes="32x32" type="image/png">-->
    <!--    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">-->
    <link rel="manifest" href="manifest.json">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#563d7c">
    <!--    <link rel="icon" href="images/favicon.ico">-->
    <meta name="msapplication-config" content="browserconfig.xml">
    <meta name="theme-color" content="#563d7c">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="userform.css" rel="stylesheet">
</head>
<body class="text-center">
<form class="form-signin" action="" method="post">
    <!--    <img class="mb-4" src="bootstrap-solid.svg" alt="" width="72" height="72">-->
    <h1 class="h3 mb-3 font-weight-normal">Please Sign In</h1>
    <label class="sr-only">Name</label>
    <input type="text" name="name" class="form-control" placeholder="Name" required="" autofocus="">
    <label class="sr-only">Email</label>
    <input type="email" name="email" class="form-control" placeholder="Email Address" required="" autofocus="">
    <label class="sr-only">Username</label>
    <input type="text" name="username" class="form-control" placeholder="Username" required="" autofocus="">
    <label class="sr-only">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password" required="">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">© 2021-2022 Sheba</p>
</form>


</body></html>