<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TrainAlarmログイン</title>
    <link rel="stylesheet" href="css/resetcss.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <div class="container border" style="width: 500px;margin-top: 1em;">
        <div class="text-center">
            <img src="image/icon.png" class="rounded mx-auto d-block" alt="icon" style="width: 30%;margin-top: 1em;">
            <h1>TrainAlarm</h1>
        </div>

            <?php
            if(isset($_GET["error"])){
                if($_GET["error"]=="none") {
                    echo "<div class='text-center alert alert-success' role='alert'>";
                    echo "登録完了";
                    echo "</div>";
                }
                if($_GET["error"]=="emptyInput") {
                    echo "<div class='text-center alert alert-danger' role='alert'>";
                    echo "入力してください";
                    echo "</div>";
                }
                if($_GET["error"]=="wrongLogin") {
                    echo "<div class='text-center alert alert-danger' role='alert'>";
                    echo "ユーザー名またはパスワードの入力に誤りがある";
                    echo "</div>";
                }
            }
            ?>

        <form action="includes/login.inc.php" method="post">
            <div class="form-group">
                <h2>ユーザＩＤ</h2>
                <input type="text" name="uid" class="form-control" >
            </div>
            <div class="form-group">
                <h2>パスワード</h2>
                <input type="password" name="pwd" class="form-control" ><br>
            </div>
            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" style="margin-bottom: 1em;" value="Login">
        </form>
        <button class="btn btn-secondary btn-lg btn-block" style="margin-bottom: 1em;" onclick="location.href='registration.php'">
            Register
        </button>
        <button class="btn btn-danger btn-lg btn-block" style="margin-bottom: 1em;" onclick="location.href='index.php'">
            Return
        </button>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>