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
<h1 class="text-center" style="margin: 1em;">ユーザプロファイル</h1>
<div class="container" style="width: 500px">
    <div class="row">
        <div class="col-sm">
            <h3 class="text-start">ユーザＩＤ:</h3>
        </div>
        <div class="col-sm">
            <h3 class="text-end"><?php echo $_SESSION["userName"];?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <h3 class="text-start">メール:</h3>
        </div>
        <div class="col-sm">
            <h3 class="text-end"><?php echo $_SESSION["userEmail"];?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <h3 class="text-start">電話番号:</h3>
        </div>
        <div class="col-sm">
            <h3 class="text-end"><?php echo $_SESSION["userPhoneNumber"];?></h3>
        </div>
    </div>
    <div class="d-grid gap-2">
        <button type="button" class="btn btn-secondary btn-lg" style="margin: 2em 0;" onclick="location.href='profile_edit.php'">
            Edit Information
        </button>
    </div>


</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="js/functions.inc.js"></script>
</body>
</html>
