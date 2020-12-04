<?php
//
//APIは、https://developer-tokyochallenge.odpt.org/ja/infoで提供されました。
//
//https://api-tokyochallenge.odpt.org/api/v4/odpt:Railway?acl:consumerKey=99ALsOEmGINOQdkB4JCC0E65hfVjF0Q9JY7nehtdRAo
date_default_timezone_set('Asia/Tokyo');
$date = date('F j, Y');
$time = date("H:i");
//APIのURLの先頭と認証キー
static $auth_key = "99ALsOEmGINOQdkB4JCC0E65hfVjF0Q9JY7nehtdRAo";
static $header = "https://api-tokyochallenge.odpt.org/api/v4/datapoints/";
$key= "?acl:consumerKey={$auth_key}";

if(isset($_POST)) {
    $operator = $_POST['operator'];
    $line = $_POST['train_line'];
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];

    $origin = str_replace("odpt.Station:","",$origin);
    $destination = str_replace("odpt.Station:","",$destination);
    $line = str_replace("odpt.Railway:","",$line);

    $url = "{$header}odpt.Railway:{$line}{$key}";
    $arr = json_decode(file_get_contents($url), true);

    //駅インデックスに基づいて、線路方向(上り/下り)決断
    for ($i = 0; $i < count($arr[0]['odpt:stationOrder']); ++$i) {
        if ($arr[0]['odpt:stationOrder'][$i]['odpt:station'] == "odpt.Station:{$origin}") {
            $origin_index = $arr[0]['odpt:stationOrder'][$i]['odpt:index'];
            $origin_ja = $arr[0]['odpt:stationOrder'][$i]['odpt:stationTitle']['ja'];
        }
        if ($arr[0]['odpt:stationOrder'][$i]['odpt:station'] == "odpt.Station:{$destination}") {
            $destination_index = $arr[0]['odpt:stationOrder'][$i]['odpt:index'];
            $destination_ja = $arr[0]['odpt:stationOrder'][$i]['odpt:stationTitle']['ja'];
        }
    }
    if ($origin_index < $destination_index)
        $direction = str_replace('odpt.RailDirection:', '', $arr[0]['odpt:ascendingRailDirection']);
    else
        $direction = str_replace('odpt.RailDirection:', '', $arr[0]['odpt:descendingRailDirection']);

    //土日祝決断　未完成
    if (date("l") == 'Saturday' or date("l") == 'Sunday')
        $day = "SaturdayHoliday";
    else
        $day = "Weekday";

    $station_time_table_url = "{$header}odpt.StationTimetable:{$origin}.{$direction}.{$day}{$key}";
    $station_time_table = json_decode(file_get_contents($station_time_table_url), true);

    //電車探索
    for ($i = 0; $i < count($station_time_table[0]['odpt:stationTimetableObject']); ++$i) {
        if ($station_time_table[0]['odpt:stationTimetableObject'][$i]['odpt:departureTime'] > $time) {
            //現在の時間に基づいて,次の電車のナンバーを
            $train_number = $station_time_table[0]['odpt:stationTimetableObject'][$i]['odpt:trainNumber'];

            $train_time_table_url = "{$header}odpt.TrainTimetable:{$line}.{$train_number}.{$day}{$key}";
            $train_time_table = json_decode(file_get_contents($train_time_table_url), true);

            //行き先確認条件
            //①行き先は最後の駅と確認
            //②行き先はダイヤに存在と確認
            //確認できたら、breakが行い、到着予定時刻取得
            //できなっかたら、次のナンバーへ行く
            if($station_time_table[0]['odpt:stationTimetableObject'][$i]['odpt:destinationStation'][0]=="odpt.Station:{$destination}") {
                $arrival_time = $train_time_table[0]['odpt:trainTimetableObject'][count($train_time_table[0]['odpt:trainTimetableObject'])-1]['odpt:arrivalTime'];
                break;
            }else{
                for ($k = count($train_time_table[0]['odpt:trainTimetableObject']); $k >= 0; --$k){
                    if($train_time_table[0]['odpt:trainTimetableObject'][$k]['odpt:departureStation']=="odpt.Station:{$destination}"
                        AND $train_time_table[0]['odpt:trainTimetableObject'][$k]['odpt:departureTime'] > $time){
                        $arrival_time = $train_time_table[0]['odpt:trainTimetableObject'][$k]['odpt:departureTime'];
                        break(2);
                    }
                }
            }
        }
    }
    $alarm_date = "{$date}\t{$arrival_time}:00";
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
    <link rel="stylesheet" href="../css/resetcss.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <!--開発$Variables-->
<!--    <p>--><?php //echo "$time";?><!--</p>-->
<!--    <p>--><?php //echo "$operator";?><!--</p>-->
<!--    <p>--><?php //echo "$line";?><!--</p>-->
<!--    <p>--><?php //echo "$origin";?><!--</p>-->
<!--    <p>--><?php //echo "$destination";?><!--</p>-->
<!--    <p>--><?php //echo "$origin_index";?><!--</p>-->
<!--    <p>--><?php //echo "$destination_index";?><!--</p>-->
<!--    <p>--><?php //echo "$direction";?><!--</p>-->
<!--    <p>--><?php //echo "$day";?><!--</p>-->
<!--    <p>--><?php //echo "$train_number";?><!--</p>-->
<!--    <p>--><?php //echo "$arrival_time";?><!--</p>-->
    <!--API Linkのまとめ-->
<!--    <p>--><?php //echo "$url";?><!--</p>-->
<!--    <p>--><?php //echo "$train_time_table_url";?><!--</p>-->
<!--    <p>--><?php //echo "$station_time_table_url";?><!--</p>-->
</div>


<div class="container border" style="width: 700px;">
    <div class="text-center">
        <img src="../image/icon.png" class="rounded mx-auto d-block" alt="icon" style="width: 20%;margin-top: 1em;">
        <h1>TrainAlarm</h1>
        <h2 style="margin: 2em 0"><strong>線路：</strong><?php echo $line;?></h2>
        <div class="row" style="margin: 2em 0">
            <div class="col-sm">
                <h2><strong>発車駅:</strong><?php echo $origin_ja;?></h2>
            </div>
            <div class="col-sm">
                <h2><strong>行先駅:</strong><?php echo $destination_ja;?></h2>
            </div>
        </div>
        <h2 style="margin: 2em 0"><strong>到着時間：</strong><?php echo $arrival_time;?></h2>
        <h2 style="margin: 2em 0"><strong>目覚まし後:</strong><span id="alarm_time"></span></h2>
    </div>
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