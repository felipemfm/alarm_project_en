<?php
include_once "function.inc.php";
include_once "dbh.inc.php";
session_start();
$_SESSION["header"] = NULL;
if (isset($conn)) {
    cancelAlarm($conn, $_SESSION["userid"]);
}
header("location: ../index.php");
exit();

