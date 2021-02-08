<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TrainAlarmSetup</title>
    <link rel="stylesheet" href="css/resetcss.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="apple-touch-icon" sizes="180x180" href="image/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="image/favicon-16x16.png">
    <link rel="manifest" href="image/site.webmanifest">
    <link rel="mask-icon" href="/image/favicon.ico" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<body onload="document.alarm.reset();">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="image/icon.png" alt="" width="30" height="24" class="d-inline-block align-top">
            TrainAlarm</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <?php
                if(isset($_SESSION["userName"])) {
                    echo "<li class='nav-item'><a class='nav-link active' href='profile.php'>Profile</a></li>";
                    echo "<li class='nav-item'><a class='nav-link active' href='user_history.php'>History</a></li>";
                }
                ?>
            </ul>
        </div>
        <?php
        if(isset($_SESSION["userName"])) {
            echo "<a class='nav-link active nav-item justify-content-end' href='includes/logout.inc.php'>Logout</a>";
        }else{
            echo "<a class='nav-link active nav-item justify-content-end' href='login.php'>Login</a>";
            echo "<a class='nav-link active nav-item justify-content-end' href='registration.php'>Register</a>";
        }
        ?>
    </div>
</nav>