<?php
//registration.php
function emptyInputRegis($username, $pwd, $pwdRepeat, $email, $phoneNumber){
    return empty($username) || empty($pwd) || empty($pwdRepeat) || empty($email) || empty($phoneNumber);
}
function invalidUid($username){
    return !preg_match("/^[a-zA-Z0-9]*$/", $username);
}
function invalidPhoneNumber($phoneNumber){
    return !preg_match("/^[0-9]*$/", $phoneNumber);
}
function invalidEmail($email){
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}
function pwdMatch($pwd,$pwdRepeat){
    return $pwd !== $pwdRepeat;
}
function uidExist($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE usersName = ? OR usersEmail =?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: registration.php?error=stmtFailed");
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        return $result = false;
    }
}
function creatUser($conn, $username, $email, $phoneNumber, $pwd){
    $sql = "INSERT INTO users (usersName, usersEmail, usersPhoneNumber, usersPwd) VALUE (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../registration.php?error=stmtFailed");
    }
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $phoneNumber, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../login.php?error=none");
}

//login.php
function emptyInputLogin($username, $pwd){
    return empty($username) || empty($pwd);
}

function loginUser($conn, $username, $pwd){
    $uidExists = uidExist($conn, $username, $username);

    if($uidExists === false){
        header("location: ../login.php?error=wrongLogin");
        exit();
    }
    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd,$pwdHashed);

    if($checkPwd === false){
        header("location: ../login.php?error=wrongLogin");
        exit();
    }else if($checkPwd===true){
        session_start();
        $_SESSION["userid"] = $uidExists["usersid"];
        $_SESSION["userName"] = $uidExists["usersName"];
        $_SESSION["userEmail"] = $uidExists["usersEmail"];
        $_SESSION["userPhoneNumber"] = $uidExists["usersPhoneNumber"];

        $activeAlarm = getActiveAlarm($conn, $_SESSION["userid"]);
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
        }else {
            header("location: ../index.php");
            exit();
        }
    }
}

//alarm.inc.php
function insertUsersHistory($conn, $userid, $operator, $line, $origin, $destination){
    $line = str_replace("{$operator}.","",$line);
    $origin = str_replace("{$operator}.{$line}.","",$origin);
    $destination = str_replace("{$operator}.{$line}.","",$destination);
    $sql = "INSERT INTO users_history (usersid,operator,line,origin,destination) VALUE (?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../index.php?error=stmtFailed");
    }
    mysqli_stmt_bind_param($stmt, "issss", $userid, $operator, $line, $origin, $destination);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function addActiveAlarm($conn, $userid, $alarm_date, $line,  $origin, $destination, $departure_time, $arrival_time){
    $sql = "INSERT INTO active_alarm (usersid,alarm_date,line,origin,destination,departure_time,arrival_time) VALUE (?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../index.php?error=stmtFailed");
    }
    mysqli_stmt_bind_param($stmt, "issssss", $userid,  $alarm_date, $line, $origin, $destination, $departure_time, $arrival_time);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function cancelAlarm ($conn, $userid){
    $sql = "DELETE FROM active_alarm WHERE usersid = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../index.php?error=stmtFailed");
    }
    mysqli_stmt_bind_param($stmt, "s", $userid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function getActiveAlarm($conn, $userid){
    $sql = "SELECT * FROM active_alarm WHERE usersid = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: registration.php?error=stmtFailed");
    }
    mysqli_stmt_bind_param($stmt, "i", $userid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        return $result = false;
    }
}

//profile.inc.php
function emptyInputEdit($edit1, $edit2, $edit3){
    return empty($edit1) || empty($edit2) || empty($edit3);
}
function updateEmail($conn, $email, $userid){
    $sql = "UPDATE users SET usersEmail = ? WHERE usersid = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../profile_edit.php?error=stmtFailed");
    }
    mysqli_stmt_bind_param($stmt, "ss", $email,$userid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function updatePhoneNumber($conn, $phoneNumber, $userid){
    $sql = "UPDATE users SET usersPhoneNumber = ? WHERE usersid = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../profile_edit.php?error=stmtFailed");
    }
    mysqli_stmt_bind_param($stmt, "ss", $phoneNumber,$userid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function updatePassword($conn, $username, $pwd, $newPwd){
    $uidExists = uidExist($conn, $username, $username);
    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd,$pwdHashed);
    if($checkPwd === false){
        header("location: ../profile_edit.php?error=wrongPwd");
        exit();
    }
    $hashedPwd = password_hash($newPwd, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET usersPwd = ? WHERE usersName = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../profile_edit.php?error=stmtFailed");
    }
    mysqli_stmt_bind_param($stmt, "ss", $hashedPwd,$username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}