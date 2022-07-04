<?php
session_start();
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
        header("Location: index.php");
        die;
    }
    else{
        echo "please enter valid information";
    }
}
?>