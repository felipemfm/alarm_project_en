<?php
include_once "access/dbh.access.php";
include_once "function/functions.php";
if (isset($_POST["submit"])){
    $phone = $_POST["phone"];

    if(empty($phone)){
        header("location: ../non_user_check.php?error=emptyInput");
        exit();
    }
    if (invalidPhoneNumber($phone) !== false) {
        header("location: ../non_user_check.php?error=invalidPhoneNumber");
        exit();
    }

    if (isset($conn)) $activeAlarm = getActiveAlarm($conn, 0, $phone);
    if($activeAlarm){
        $_SESSION["alarm_date"] = $activeAlarm["alarm_date"];
        $_SESSION["line"] = $activeAlarm["line"];
        $_SESSION["origin"] = $activeAlarm["origin"];
        $_SESSION["destination"] = $activeAlarm["destination"];
        $_SESSION["departure_time"] = $activeAlarm["departure_time"];
        $_SESSION["arrival_time"] = $activeAlarm["arrival_time"];
        if($_SESSION["arrival_time"] <= date('H:i')){
            header("location: cancel.inc.php");
            exit();
        }
        header("location: ../alarm_countdown.php");
        exit();
    }else{
        header("location: ../non_user_check.php?error=notFound");
        exit();
    }
}