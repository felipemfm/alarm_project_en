<?php
include_once "function.inc.php";
include_once "dbh.inc.php";
session_start();
if (isset($conn)) {
    cancelAlarm($conn, $_SESSION["userid"]);
}
unset($_SESSION["alarm_date"],$_SESSION["line"],$_SESSION["origin"],$_SESSION["destination"],$_SESSION["departure_time"],$_SESSION["arrival_time"]);
header("location: ../index.php");
exit();

