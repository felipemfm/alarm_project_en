<?php
    session_start();
    if(isset($_SESSION["header"])){
        header("location: alarm_countdown.php?{$_SESSION["header"]}");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TrainAlarmSetup</title>
    <link rel="stylesheet" href="css/resetcss.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">



    <link rel="apple-touch-icon" sizes="180x180" href="image/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="image/favicon-16x16.png">
    <link rel="manifest" href="image/site.webmanifest">
    <link rel="mask-icon" href="/image/favicon.ico" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<body onload="document.alarm.reset();">

<?php include_once "includes/nav.inc.php";?>
<div class="container" style="width: 500px">

    <h1 class='text-center' style='padding: 1em;'>アラム設定</h1>
    <div id="error" class="text-center" style="color: red">
        <?php
        if(isset($_GET["error"])){
            echo "<div class='text-center alert alert-danger' role='alert'>";
            if($_GET["error"]=="emptyInput"){
                echo "入力してください";
            }else if ($_GET["error"]=="sameAs"){
                echo "発車駅と行先駅は異なければいけません";
            }else if ($_GET["error"]=="unavailable"){
                echo "選択不可";
            }
            echo "</div>";
        }
        ?>
    </div>
    <form action="includes/alarm.inc.php" method="post" name="alarm">
        <h3>鉄道会社</h3>
        <div class="form-group">
            <select name="operator" id="operator" class="form-control form-select"  onchange="getLine()">
                <option value=""selected></option>
                <option value="JR-East">JR-East</option>
                <option value="TokyoMetro">TokyoMetro</option>
                <option value="Toei">Toei</option>
                <option value="Yurikamome">Yurikamome</option>
                <option value="Keio">Keio</option>
                <option value="Keisei">Keisei</option>
                <option value="Keikyu">Keikyu</option>
                <option value="Odakyu">Odakyu</option>
                <option value="Seibu">Seibu</option>
                <option value="TokyoMonorail">TokyoMonorail</option>
                <option value="Tokyu">Tokyu</option>
                <option value="TWR">Rinkai</option>
                <option value="Tobu">Tobu</option>
                <option value="SaitamaRailway">SaitamaRailway</option>
            </select>
        </div>
        <div class="form-group">
            <h3>線路</h3>
            <select name="train_line" id="train_line" class="form-control form-select"  onchange="getStation()">
                <option value="" selected ></option>
            </select>
        </div>
        <div class="form-group">
            <h3>発車駅</h3>
            <select name="origin" id="origin" class="form-control form-select" >
                <option value="" selected ></option>
            </select>
        </div>
        <div class="form-group">
            <h3>行先駅</h3>
            <select name="destination" id="destination" class="form-control form-select" >
                <option value="" selected ></option>
            </select>
        </div>
        <div class="row">
            <div class="col">
                <input type="submit" id="submit" name="submit" class="btn btn-success btn-lg btn-block" style="margin-bottom: 1em;">
            </div>
            <div class="col">
                <input type="reset" class="btn btn-primary btn-lg btn-block" style="margin-bottom: 1em;" name="クリア" onclick="resetValue()">
            </div>
        </div>
    </form>
</div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/functions.inc.js"></script>
</body>
</html>