<?php include_once "includes/header.inc.php"?>
    <div class="container" style="width: 500px;">

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
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>