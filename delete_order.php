<?php
session_start();
include ("connection.php");
include ("function.php");

if(isset($_GET['deleteac'])) {
    $id = $_GET['deleteac'];
    $query = "DELETE FROM `ac` WHERE `ac`.`id` = '$id' ";
    $result = mysqli_query($con, $query);

    if($result) {
        echo "successful";
    } else {
        echo "not successful";
    }
    header("Location: dashboard.php");
}

if(isset($_GET['deleteceil'])) {
    $id = $_GET['deleteceil'];
    $query = "DELETE FROM `ceil` WHERE `ceil`.`id` = '$id' ";
    $result = mysqli_query($con, $query);

    if($result) {
        echo "successful";
    } else {
        echo "not successful";
    }
    header("Location: dashboard.php");
}

if(isset($_GET['deletedrill'])) {
    $id = $_GET['deletedrill'];
    $query = "DELETE FROM `drill` WHERE `drill`.`id` = '$id' ";
    $result = mysqli_query($con, $query);

    if($result) {
        echo "successful";
        $orders = $_SESSION['orders'] + 1;
        $id = $_SESSION['id'];
        $query = "UPDATE `user` SET `orders` = '$orders' WHERE `user`.`id` = '$id'";
        mysqli_query($con, $query);
    } else {
        echo "not successful";
    }
    header("Location: dashboard.php");
}

if(isset($_GET['deletedrive'])) {
    $id = $_GET['deletedrive'];
    $query = "DELETE FROM `drive` WHERE `drive`.`id` = '$id' ";
    $result = mysqli_query($con, $query);

    if($result) {
        echo "successful";
        $orders = $_SESSION['orders'] + 1;
        $id = $_SESSION['id'];
        $query = "UPDATE `user` SET `orders` = '$orders' WHERE `user`.`id` = '$id'";
        mysqli_query($con, $query);
    } else {
        echo "not successful";
    }
    header("Location: dashboard.php");
}

if(isset($_GET['deletepaint'])) {
    $id = $_GET['deletepaint'];
    $query = "DELETE FROM `paint` WHERE `paint`.`id` = '$id' ";
    $result = mysqli_query($con, $query);

    $query = "UPDATE `user` SET `orders` = '3' WHERE `user`.`id` = 20";
    mysqli_query($con, $query);

    if($result) {
        echo "successful";
    } else {
        echo "not successful";
    }
    header("Location: dashboard.php");
}

if(isset($_GET['deleteplumbing'])) {
    $id = $_GET['deleteplumbing'];
    $query = "DELETE FROM `plumbing` WHERE `plumbing`.`id` = '$id' ";
    $result = mysqli_query($con, $query);

    if($result) {
        echo "successful";
    } else {
        echo "not successful";
    }
    header("Location: dashboard.php");
}

if(isset($_GET['deleteweld'])) {
    $id = $_GET['deleteweld'];
    $query = "DELETE FROM `weld` WHERE `weld`.`id` = '$id' ";
    $result = mysqli_query($con, $query);

    if($result) {
        echo "successful";
    } else {
        echo "not successful";
    }
    header("Location: dashboard.php");
}