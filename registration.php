<?php include_once "includes/header.inc.php"?>
    <div class="container bg-white border rounded-3" style="width: 500px;">

        <div class="text-center">
            <img src="image/icon.png" class="rounded mx-auto d-block" alt="icon" style="width: 30%;margin-top: 1em;">
            <h1>TrainAlarm</h1>
        </div>
        <?php include "includes/error_handler.inc.php";?>
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
                <h2>携帯番号(11桁)</h2>
                <input type="text" name="phoneNumber" class="form-control" ><br>
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg mb-3">
        </form>
    </div>
<?php include_once "includes/footer.inc.html";?>
</html>