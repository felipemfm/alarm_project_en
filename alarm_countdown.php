<?php
    session_start();
    date_default_timezone_set('Asia/Tokyo');
    $alarm_date = $_GET[alarm_date];
    $line = $_GET[line];
    $origin_ja = $_GET[ori];
    $destination_ja = $_GET[des];
    $departure_time = $_GET[de_time];
    $arrival_time = $_GET[arri_time];
    if($arrival_time < date("H:i")){
        header("location: includes/cancel.inc.php");
        exite();
    }
?>

<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TrainAlarm</title>
    <link rel="stylesheet" href="css/resetcss.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="apple-touch-icon" sizes="180x180" href="image/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="image/favicon-16x16.png">
    <link rel="manifest" href="image/site.webmanifest">
    <link rel="mask-icon" href="/image/favicon.ico" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">


</head>
<body>
<?php include_once "includes/header.inc.php";?>
<div class="container" style="width: 700px;">
    <div class="text-center">
        <h2 style="margin: 1em 0 0.5em 0"><strong>線路</strong></h2>
        <h2 style="margin: 0.5em 0 1em 0"><?php echo $line;?></h2>
        <div class="row" style="margin: 1em 0 0.5em 0">
            <div class="col-sm">
                <h2><strong>発車駅</strong></h2>
            </div>
            <div class="col-sm">
                <h2><strong>行先駅</strong></h2>
            </div>
        </div>
        <div class="row" style="margin: 0.5em 0 1em 0">
            <div class="col-sm">
                <h2><?php echo $origin_ja;?></h2>
            </div>
            <div class="col-sm">
                <h2><?php echo $destination_ja;?></h2>
            </div>
        </div>
        <div class="row" style="margin: 1em 0 0.5em 0">
            <div class="col-sm">
                <h2><strong>出発時間</strong></h2>
            </div>
            <div class="col-sm">
                <h2><strong>到着時間</strong></h2>
            </div>
        </div>
        <div class="row" style="margin: 0.5em 0 1em 0">
            <div class="col-sm">
                <h2><?php echo $departure_time;?></h2>
            </div>
            <div class="col-sm">
                <h2><?php echo $arrival_time;?></h2>
            </div>
        </div>
        <!--        <h2 style="margin: 2em 0"><strong>到着時間：</strong>--><?php //echo $arrival_time;?><!--</h2>-->
        <h2 style="margin: 2em 0"><strong>到着アラーム:</strong><span id="alarm_time"></span></h2>
    </div>
    <form action="includes/cancel.inc.php" method="post">
        <button type="submit" class="btn btn-danger btn-lg btn-block" style="margin-bottom: 1em;" ">
        Cancel
        </button>
    </form>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    //目覚ましcountDownScript
    var countDown = new Date("<?php echo "$alarm_date"?>").getTime();
    var x = setInterval(function (){
        var now = new Date().getTime();
        var distance = countDown - now;

        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("alarm_time").innerHTML = hours+"時"+minutes+"分"+seconds+"秒";

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("alarm_time").innerHTML = "EXPIRED";
        }
    },1000);
</script>
</body>
</html>