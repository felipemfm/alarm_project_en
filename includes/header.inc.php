
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TrainAlarm</title>
    <link rel="stylesheet" href="css/resetcss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">


    <link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon">
    <link rel="icon" href="image/favicon.ico" type="image/x-icon">
    <meta name="robots" content="none,noindex,nofollow">
</head>
<body onload="document.alarm.reset();">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="./">
            <img src="image/icon.png" alt="" width="30" height="24" class="d-inline-block align-top">
            TrainAlarm</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <?php
                if(isset($_SESSION["userName"])) {
                    echo "<li class='nav-item'><a class='nav-link active' href='profile.php'>プロフィール</a></li>";
                    echo "<li class='nav-item'><a class='nav-link active' href='user_history.php'>履歴</a></li>";
                }else{
                    echo "<li class='nav-item'><a class='nav-link active' href='non_user_check.php'>アラーム確認</a></li>";
                }
                ?>
            </ul>
            <?php
            if(isset($_SESSION["userName"])) {
                echo "<a class='nav-link active nav-item justify-content-end' href='includes/logout.inc.php'>ログアウト</a>";
            }else{
                echo "<a class='nav-link active nav-item justify-content-end' href='login.php'>ログイン</a>";
                echo "<a class='nav-link active nav-item justify-content-end' href='registration.php'>登録</a>";
            }
            ?>
        </div>
    </div>
</nav>