<?php
//
//APIは、https://developer-tokyochallenge.odpt.org/ja/infoで提供されました。
//
//https://api-tokyochallenge.odpt.org/api/v4/odpt:Railway?acl:consumerKey=99ALsOEmGINOQdkB4JCC0E65hfVjF0Q9JY7nehtdRAo
session_start();
include_once "function.inc.php";
include_once "dbh.inc.php";
include_once "key.inc.php";

if(isset($_POST["submit"])) {
    date_default_timezone_set('Asia/Tokyo');
    $date = date('F j, Y');
    $time = date("H:i");
    //APIのURLの先頭と認証キー
    $header = "https://api-tokyochallenge.odpt.org/api/v4/datapoints/";
    if (isset($auth_key)) {
        $key= "?acl:consumerKey={$auth_key}";
    }

    $operator = $_POST['operator'];
    $line = $_POST['train_line'];
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];

    if(empty($operator)||empty($line)||empty($origin)||empty($destination)){
        header("location: ../index.php?error=emptyInput");
        exit();
    }
    if($origin == $destination){
        header("location: ../index.php?error=sameAs");
        exit();
    }

    $origin = str_replace("odpt.Station:","",$origin);
    $destination = str_replace("odpt.Station:","",$destination);
    $line = str_replace("odpt.Railway:","",$line);

    $url = "{$header}odpt.Railway:{$line}{$key}";
    $arr = json_decode(file_get_contents($url), true);

    //駅インデックスに基づいて、線路方向(上り/下り)決断
    for ($i = 0; $i < count($arr[0]['odpt:stationOrder']); ++$i) {
        if ($arr[0]['odpt:stationOrder'][$i]['odpt:station'] == "odpt.Station:{$origin}") {
            $origin_index = $arr[0]['odpt:stationOrder'][$i]['odpt:index'];
            $origin_en = $arr[0]['odpt:stationOrder'][$i]['odpt:stationTitle']['en'];
        }
        if ($arr[0]['odpt:stationOrder'][$i]['odpt:station'] == "odpt.Station:{$destination}") {
            $destination_index = $arr[0]['odpt:stationOrder'][$i]['odpt:index'];
            $destination_en = $arr[0]['odpt:stationOrder'][$i]['odpt:stationTitle']['en'];
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
            $departure_time = $station_time_table[0]['odpt:stationTimetableObject'][$i]['odpt:departureTime'];

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
    if(empty($arrival_time)){
        header("location: ../index.php?error=unavailable");
        exit();
    }else{
        $alarm_date= "{$date}\t{$arrival_time}:00";
        $header = "alarm_date={$alarm_date}&line={$line}&ori={$origin_en}&des={$destination_en}&de_time={$departure_time}&arri_time={$arrival_time}";
        if (isset($conn)) {
            insertUsersHistory($conn, $_SESSION["userid"], $operator, $line, $origin, $destination);
            addActiveAlarm($conn, $_SESSION["userid"], $header);
        }
        header("location: ../alarm_countdown.php?{$header}");
        exit();
    }
}else{
    header("location: ../index.php");
    exit();
}

//    開発$Variables
//echo "$time";
//echo "$operator";
//echo "$line";
//echo "$origin";
//echo "$destination";
//echo "$origin_index";
//echo "$destination_index";
//echo "$direction";
//echo "$day";
//echo "$train_number";
//echo "$arrival_time";
//API Linkのまとめ
//echo "$url";
//echo "$station_time_table_url";
//echo "$train_time_table_url";

