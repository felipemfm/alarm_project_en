<?php
session_start();
include_once "function/functions.php";
include_once "access/dbh.access.php";
if(isset($_POST["submit"])) {
    $favid = $_POST["id"];
    if (isset($conn)) deleteUsersFavorite($conn,$favid);
    header("location: ../");
}