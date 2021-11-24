<?php
if (isset($_GET["error"])) {
    echo "<div class='text-center alert alert-danger ' role='alert'>";
    if($_GET["error"] == "emptyInput") {
        echo "Please enter the required information";
    } else if ($_GET["error"] == "invalidUid") {
        echo "Invalid Username";
    } else if ($_GET["error"] == "invalidEmail") {
        echo "Invalid Email Address";
    } else if ($_GET["error"] == "invalidPhoneNumber") {
        echo "Invalid Phonenumber";
    } else if ($_GET["error"] == "pwdMatch") {
        echo "Password doesn't match";
    } else if ($_GET["error"] == "userTaken") {
        echo "The entered Username or Email is already in used";
    }else if ($_GET["error"]=="sameAs"){
        echo "Departure and Destination stations can not be the same";
    }else if ($_GET["error"]=="unavailable"){
        echo "Unavailable at the Time";
    }else if($_GET["error"]=="wrongLogin") {
        echo "The entered Username or Password are incorrect";
    }else if ($_GET["error"]=="notFound"){
        echo "Can not found an Active Alarm";
    }else if($_GET["error"]=="wrongPwd") {
        echo "The Password in incorrect";
    }
    echo "</div>";
}
if(isset($_GET["success"])) {
    echo "<div class='text-center alert alert-success' role='alert'>";
    if ($_GET["success"] == "regis") {
        echo "Registration Complete";
    }else if($_GET["success"]== "edit"){
        echo "Edit Complete";
    }
    echo "</div>";

}
