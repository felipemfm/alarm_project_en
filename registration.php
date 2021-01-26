<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TrainAlarm会員登録</title>
    <link rel="stylesheet" href="css/resetcss.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <div class="container border" style="width: 500px;">

        <div class="text-center">
            <img src="image/icon.png" class="rounded mx-auto d-block" alt="icon" style="width: 30%;margin-top: 1em;">
            <h1>TrainAlarm</h1>
        </div>

            <?php
            if(isset($_GET["error"])){
                echo "<div class='text-center alert alert-danger ' role='alert'>";
                if($_GET["error"]=="emptyInput"){
                    echo "入力してください";
                }else if ($_GET["error"]=="invalidUid"){
                    echo "インバリッドユーザID";
                }else if ($_GET["error"]=="invalidEmail"){
                    echo "インバリッドユーザメール";
                }else if ($_GET["error"]=="invalidPhoneNumber"){
                    echo "インバリッド電話番号";
                }else if ($_GET["error"]=="pwdMatch"){
                    echo "パスワードが合わない";
                }else if ($_GET["error"]=="userTaken"){
                    echo "ユーザまたはメールはユーザー名は既に取られています";
                }
                echo "</div>";
            }
            ?>

        <form action="includes/registration.inc.php" method="post">
            <div class="form-group">
                <h2>ユーザID</h2>
                <input type="text" name="userid" class="form-control" >
            </div>
            <div class="form-group">
                <h2>パスワード</h2>
                <input type="password" name="pwd" class="form-control" ><br>
            </div>
            <div class="form-group">
                <h2>パスワード確認</h2>
                <input type="password" name="pwdRepeat" class="form-control" ><br>
            </div>
            <div class="form-group">
                <h2>Email</h2>
                <input type="email" name="email" class="form-control" ><br>
            </div>
            <div class="form-group">
                <h2>携帯番号</h2>
                <input type="text" name="phoneNumber" class="form-control" ><br>
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg btn-block" style="margin-bottom: 1em;">
        </form>
        <button class="btn btn-danger btn-lg btn-block" style="margin-bottom: 1em;" onclick="location.href='login.php'">
            Return
        </button>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>