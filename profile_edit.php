<?php
session_start();
if(!isset($_SESSION["userName"])){
    header("location: index.php");
    exit();
}
?>
<!DOCTYPE>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>UserProfile</title>
    <link rel="stylesheet" href="css/resetcss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body onload="document.alarm.reset();">
<?php include_once "includes/nav.inc.php";?>

<div class="container" style="width: 500px">
    <h1 class="text-center" style="margin: 1em;">プロファイル編集</h1>
    <?php
    if(isset($_GET["error"])){
        if($_GET["error"]=="none") {
            echo "<div class='text-center alert alert-success' role='alert'>";
            echo "編集完了";
            echo "</div>";
        }
        if($_GET["error"]=="emptyInput") {
            echo "<div class='text-center alert alert-danger' role='alert'>";
            echo "入力してください";
            echo "</div>";
        }
        if($_GET["error"]=="invalidEmail") {
            echo "<div class='text-center alert alert-danger' role='alert'>";
            echo "インバリッドユーザメール";
            echo "</div>";
        }
        if($_GET["error"]=="invalidPhoneNumber") {
            echo "<div class='text-center alert alert-danger' role='alert'>";
            echo "インバリッド電話番号";
            echo "</div>";
        }
        if($_GET["error"]=="pwdNotMatch") {
            echo "<div class='text-center alert alert-danger' role='alert'>";
            echo "パスワードが合わない";
            echo "</div>";
        }
        if($_GET["error"]=="wrongPwd") {
            echo "<div class='text-center alert alert-danger' role='alert'>";
            echo "間違えたパスワード";
            echo "</div>";
        }
    }
    ?>
    <form action="includes/profile.inc.php" method="post">
        <div class="form-group ">
            <h2>メール</h2>
            <div class="input-group mb-3">
                <input type="text" name="email" class="form-control" >
                <button class="btn btn-primary" type="submit" name="submit" id="button-addon2">Edit</button>
            </div>
        </div>
    </form>
    <form action="includes/profile.inc.php" method="post">
        <div class="form-group ">
            <h2>電話番号</h2>
            <div class="input-group mb-3">
                <input type="text" name="phoneNumber" class="form-control" >
                <button class="btn btn-primary" type="submit" name="submit" id="button-addon2">Edit</button>
            </div>
        </div>
    </form>
    <form action="includes/profile.inc.php" method="post">
        <div class="form-group ">
            <h2>パスワード</h2>
            <p>新パスワード</p>
            <input type="password" name="newPwd" class="form-control" >
            <p>新パスワード確認</p>
            <input type="password" name="newPwdRepeat" class="form-control">
            <p>現在パスワード</p>
            <div class="input-group mb-3">
                <input type="password" name="pwd" class="form-control" >
                <button class="btn btn-primary" type="submit" name="submit" id="button-addon2">Edit</button>
            </div>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="js/functions.inc.js"></script>
</body>
</html>
