<?php

session_start();
include("connection.php");
include("function.php");

$id = $_SESSION['id'];

$query = "DELETE FROM `user` WHERE `user`.`id` = '$id'";
mysqli_query($con, $query);

header("Location: logout.php");
die;