<?php
session_start();
?>

<!DOCTYPE>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>UserHistory</title>
    <link rel="stylesheet" href="css/resetcss.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body onload="document.alarm.reset();">
<?php include_once "includes/nav.inc.php";?>
<div class="container" style="width: 1000px">
    <h2 class="text-center" style="margin-bottom: 1em">ユーザ履歴</h2>
    <div class="container" style="width: 950px;height: 500px; overflow: auto;">
    <table class='table table-hover table-sm'>
        <?php
        if(isset($_SESSION["userName"])){
            include_once "includes/user-history.inc.php";
        }else{
            header("location: index.php");
            exit();
        }?>
    </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/functions.inc.js"></script>
</body>
</html>