<?php
include_once "function.inc.php";
include_once "dbh.inc.php";
session_start();
if (isset($conn)) {
    if(isset($_SESSION["userName"]))
        cancelAlarm($conn, $_SESSION["userid"],$_SESSION["userPhoneNumber"]);
    if(isset($_SESSION["nonUserPhoneNumber"]))
        cancelAlarm($conn, 0,$_SESSION["nonUserPhoneNumber"]);
        unset($_SESSION["nonUserPhoneNumber"]);
}
unset($_SESSION["alarm_date"],$_SESSION["line"],$_SESSION["origin"],$_SESSION["destination"],$_SESSION["departure_time"],$_SESSION["arrival_time"]);
header("location: ../");
exit();

