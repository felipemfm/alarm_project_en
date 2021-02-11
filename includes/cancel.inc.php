<?php
include_once "function.inc.php";
include_once "dbh.inc.php";
session_start();
if (isset($conn)) {
    cancelAlarm($conn, $_SESSION["userid"]);
}
header("location: ../index.php");
exit();

