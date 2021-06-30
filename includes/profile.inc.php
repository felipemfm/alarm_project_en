<?php
if(isset($_POST["submit"])){
    session_start();
    include_once "access/dbh.access.php";
    include_once "function/functions.php";

    if(isset($_POST["email"])){
        $email = $_POST["email"];
        if(emptyInputEdit($email,$email,$email)!==false){
            header("location: ../profile_edit.php?error=emptyInput");
            exit();
        }
        if (invalidEmail($email) !== false) {
            header("location: ../profile_edit.php?error=invalidEmail");
            exit();
        }
        if(isset($conn)){
            updateEmail($conn, $email, $_SESSION["userid"]);
        }
        $_SESSION["userEmail"] = $email;
        header("location: ../profile_edit.php?success=edit");
        exit();
    }
    if(isset($_POST["phoneNumber"])){
        $phoneNumber = $_POST["phoneNumber"];
        if(emptyInputEdit($phoneNumber,$phoneNumber,$phoneNumber)!==false){
            header("location: ../profile_edit.php?error=emptyInput");
            exit();
        }
        if (invalidPhoneNumber($phoneNumber) !== false) {
            header("location: ../profile_edit.php?error=invalidPhoneNumber");
            exit();
        }
        if(isset($conn)){
            updatePhoneNumber($conn, $phoneNumber, $_SESSION["userid"]);
        }
        $_SESSION["userPhoneNumber"] = $phoneNumber;
        header("location: ../profile_edit.php?success=edit");
        exit();
    }
    if(isset($_POST["pwd"])){
        $pwd = $_POST["pwd"];
        $newPwd = $_POST["newPwd"];
        $newPwdRepeat = $_POST["newPwdRepeat"];
        if(emptyInputEdit($pwd,$newPwd,$newPwdRepeat) !== false){
            header("location: ../profile_edit.php?error=emptyInput");
            exit();
        }
        if(pwdMatch($newPwd,$newPwdRepeat) !== false){
            header("location: ../profile_edit.php?error=pwdNotMatch");
            exit();
        }
        if(isset($conn)){
            updatePassword($conn, $_SESSION["userName"],$pwd,$newPwd);
        }
        header("location: ../profile_edit.php?success=edit");
        exit();
    }
}else{
    header("location: ../");
    exit();
}