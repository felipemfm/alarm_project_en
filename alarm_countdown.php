<?php
    session_start();
    date_default_timezone_set('Asia/Tokyo');
    $alarm_date = $_SESSION["alarm_date"];
    $line = $_SESSION["line"];
    $origin = $_SESSION["origin"];
    $destination = $_SESSION["destination"];
    $departure_time = $_SESSION["departure_time"];
    $arrival_time = $_SESSION["arrival_time"];
    if($arrival_time < date("H:i")){
        header("location: includes/cancel.inc.php");
        exite();
    }
?>
<?php include_once "includes/header.inc.php";?>
<div class="container bg-white border rounded-3 mt-3" style="width: 700px;">
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
                <h2><?php echo $origin;?></h2>
            </div>
            <div class="col-sm">
                <h2><?php echo $destination;?></h2>
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
    <form action="includes/cancel.inc.php" method="post"">
        <button type="submit" class="btn btn-danger btn-lg" style="margin-bottom: 1em;" ">
        Cancel
        </button>
    </form>

</div>
<?php include_once "includes/footer.inc.html";?>
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
</html>