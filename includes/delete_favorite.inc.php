<?php
session_start();
include_once "function.inc.php";
include_once "dbh.inc.php";
if(isset($_POST["submit"])) {
    $favid = $_POST["id"];
    if (isset($conn)) deleteUsersFavorite($conn,$favid);
    header("location: ../");
}