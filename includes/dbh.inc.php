<?php

$serverName = "localhost";
$dBUsername = "hew2020_00625";
$dBPassword = "";
$dBName = "hew2020_00625";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Connection failed:" . mysqli_connect_error());
}