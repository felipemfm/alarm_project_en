<?php
session_start();
if(!isset($_SESSION["userName"])){
    header("location: index.php");
    exit();
}
?>
<?php include_once "includes/header.inc.php";?>

<div class="container bg-white border rounded-3 mt-5 pb-3" style="width: 500px">
    <h1 class="text-center" style="margin: 1em;">プロファイル編集</h1>
    <?php include_once "includes/error_handler.inc.php"?>
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
            <input type="password" name="pwd" class="form-control" >
            <button class="btn btn-primary mt-3" type="submit" name="submit">Edit</button>
        </div>
    </form>
</div>
<?php include_once "includes/footer.inc.html";?>
</html>
