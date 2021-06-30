<?php include_once "add/header.add.php" ?>
    <div class="container mt-3 pb-5 bg-white border rounded-3" style="width: 500px;">
        <div class="text-center">
            <img src="image/icon.png" class="rounded mx-auto d-block" alt="icon" style="width: 30%;margin-top: 1em;">
            <h1>TrainAlarm</h1>
        </div>

            <?php include_once "add/error_handler.add.php";?>

        <form action="./includes/login.inc.php" method="post">
            <div class="form-group">
                <h2>ユーザＩＤ</h2>
                <input type="text" name="uid" class="form-control" >
            </div>
            <div class="form-group">
                <h2>パスワード</h2>
                <input type="password" name="pwd" class="form-control" ><br>
            </div>
            <input type="submit" name="submit" value="ログイン" class="btn btn-primary btn-lg" value="Login">
        </form>
    </div>
<?php include_once "add/footer.add.html";?>
</html>