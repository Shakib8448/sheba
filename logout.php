<?php
session_start();

if( isset($_SESSION['user_id']) ) {
    unset($_SESSION['user_id']);
}
else {
    header("Location: login.php");
}

header("Location: index.php");

