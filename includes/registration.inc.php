<?php

if(isset($_POST['submit'])) {
    $username = $_POST['userid'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdRepeat'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];

    require_once 'dbh.inc.php';
    require_once 'function.inc.php';

    if (emptyInputRegis($username, $pwd, $pwdRepeat, $email, $phoneNumber) !== false) {
        header("location: ../registration.php?error=emptyInput");
        exit();
    }
    if (invalidUid($username) !== false) {
        header("location: ../registration.php?error=invalidUid");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../registration.php?error=invalidEmail");
        exit();
    }
    if (invalidPhoneNumber($phoneNumber) !== false) {
        header("location: ../registration.php?error=invalidPhoneNumber");
        exit();
    }
    if (pwdMatch($pwd,$pwdRepeat) !== false) {
        header("location: ../registration.php?error=pwdMatch");
        exit();
    }
    if (isset($conn)) {
        if (uidExist($conn, $username, $email) !== false) {
            header("location: ../registration.php?error=userTaken");
            exit();
        }
    }
    creatUser($conn, $username, $email, $phoneNumber, $pwd);

}else{
    header("location: ../registration.php");
    exit();
}

