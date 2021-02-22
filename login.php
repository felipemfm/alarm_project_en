<?php include_once "includes/header.inc.php"?>
    <div class="container mt-3 pb-5 bg-white border rounded-3" style="width: 500px;">
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
            <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Login">
        </form>
    </div>
<?php include_once "includes/footer.inc.html";?>
</html>