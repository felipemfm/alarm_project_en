<?php

if(isset($_POST["submit"])){

    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    include_once "access/dbh.access.php";
    include_once "function/functions.php";

    if (emptyInputLogin($username, $pwd) !== false) {
        header("location: ../login.php?error=emptyInput");
        exit();
    }

    if (isset($conn)) {
        loginUser($conn, $username, $pwd);
    }
}else{
    header("location: ../login.php");
    exit();
}