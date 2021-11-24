<?php

session_start();
include_once "function/functions.php";
include_once "access/dbh.access.php";
if(isset($_POST["submit"])) {
    date_default_timezone_set('Asia/Tokyo');
    $time = date("H:i");

    //The $day_check array is used to check if the day's date is a Saturday, Sunday, or a holiday.
    $day_check = array(9,10,11,16,17,23,24,30,31,37,38,42,44,45,51,52,58,59,65,66,72,73,79,80,86,87,93,94,100,101,107,108,114,115,119,
        121,122,123,124,125,128,129,135,136,142,143,149,150,156,157,163,164,170,171,177,178,184,185,191,192,198,199,203,204,205,206,212,
        213,219,220,221,226,227,233,234,240,241,247,248,254,255,261,262,263,266,268,269,275,276,282,283,289,290,296,297,303,304,310,311,
        317,318,324,325,327,331,332,338,339,345,346,352,353,359,360);

    //The beginning of the API URL and the authentication key
    $auth_key = file_get_contents("./key/key.txt",false,null,0,43);
    $key= "?acl:consumerKey={$auth_key}";
    $header = "https://api-tokyochallenge.odpt.org/api/v4/datapoints/";

    $operator = $_POST['operator'];
    $line = $_POST['train_line'];
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];

    //Validates imputed information
    if(empty($operator)||empty($line)||empty($origin)||empty($destination)||(!isset($_SESSION["userName"])&&empty($_POST["phone"]))){
        header("location: ../?error=emptyInput");
        exit();
    }
    if($origin == $destination){
        header("location: ../?error=sameAs");
        exit();
    }
    //This is a special validation for unregistered user
    if (isset($_POST["phone"]) && invalidPhoneNumber($_POST["phone"]) !== false) {
        header("location: ../?error=invalidPhoneNumber");
        exit();
    }

    $origin = str_replace("odpt.Station:","",$origin);
    $destination = str_replace("odpt.Station:","",$destination);
    $line = str_replace("odpt.Railway:","",$line);

    $url = "{$header}odpt.Railway:{$line}{$key}";
    $arr = json_decode(file_get_contents($url), true);

    //Line direction (up/down) decision based on station index
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

    //Checks if it is a Holliday or Weekend
    $today = date('z')+1;
    if (in_array($today, $day_check))
        $day = "SaturdayHoliday";
    else
        $day = "Weekday";

    $station_time_table_url = "{$header}odpt.StationTimetable:{$origin}.{$direction}.{$day}{$key}";
    $station_time_table = json_decode(file_get_contents($station_time_table_url), true);

    //Train Search
    for ($i = 0; $i < count($station_time_table[0]['odpt:stationTimetableObject']); ++$i) {
        if ($station_time_table[0]['odpt:stationTimetableObject'][$i]['odpt:departureTime'] > $time) {
            //Find the number of the next train based on the current time.
            $train_number = $station_time_table[0]['odpt:stationTimetableObject'][$i]['odpt:trainNumber'];
            $departure_time = $station_time_table[0]['odpt:stationTimetableObject'][$i]['odpt:departureTime'];

            $train_time_table_url = "{$header}odpt.TrainTimetable:{$line}.{$train_number}.{$day}{$key}";
            $train_time_table = json_decode(file_get_contents($train_time_table_url), true);

            //Destination confirmation conditions.
            //First confirms if the destation is also the trains last stop and perform a break if positive
            //Else the programm will loop throught the line arrival times and check if the train number is presented
            //If confirmed, break is performed and estimated arrival time is obtained.
            //if not, go to the next number
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
        header("location: ../?error=unavailable");
        exit();
    }else{
        //The variables here will be passed throught a SESSION to the alarm countdown page 
        $alarm_date = date("F j, Y")."\t".$arrival_time.":00";
        $_SESSION["alarm_date"] = $alarm_date;
        $_SESSION["line"] = $line;
        $_SESSION["origin"] = $origin_en;
        $_SESSION["destination"] = $destination_en;
        $_SESSION["departure_time"] = $departure_time;
        $_SESSION["arrival_time"] = $arrival_time;

        if (isset($conn)) {
            //Database interaction for unregistered users
            if(isset($_POST["phone"])){
                $_SESSION["nonUserPhoneNumber"] = $_POST["phone"];
                addActiveAlarm($conn, 0, $_SESSION["nonUserPhoneNumber"], $alarm_date, $line, $origin_en, $destination_en, $departure_time, $arrival_time);
            //Database interation for registered users
            }else if(isset($_SESSION["userName"])){
                cancelAlarm($conn, $_SESSION["userid"],$_SESSION["userPhoneNumber"]);
                insertUsersHistory($conn, $_SESSION["userid"], $operator, $line, $origin, $destination);
                addActiveAlarm($conn, $_SESSION["userid"], $_SESSION["userPhoneNumber"], $alarm_date, $line, $origin_en, $destination_en, $departure_time, $arrival_time);
                if (isset($_POST["fav"])) {
                    insertUsersFavorite($conn, $_SESSION["userid"], $operator, $line, $origin, $destination);
                }
            }
        }
        header("location: ../alarm_countdown.php");
        exit();
    }
}else{
    header("location: ../");
    exit();
}

