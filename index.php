<?php
session_start();
include_once "includes/header.inc.php";
if($_SESSION["alarm_date"]){
    header("location: alarm_countdown.php");
    exit();
}
?>
<div class="container bg-white border rounded-3 mt-3 pb-3" style="width: 500px">

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
<!--                <option value="Yurikamome">Yurikamome</option>-->
<!--                <option value="Keio">Keio</option>-->
<!--                <option value="Keisei">Keisei</option>-->
<!--                <option value="Keikyu">Keikyu</option>-->
<!--                <option value="Odakyu">Odakyu</option>-->
<!--                <option value="Seibu">Seibu</option>-->
<!--                <option value="TokyoMonorail">TokyoMonorail</option>-->
<!--                <option value="Tokyu">Tokyu</option>-->
                <option value="TWR">Rinkai</option>
<!--                <option value="Tobu">Tobu</option>-->
<!--                <option value="SaitamaRailway">SaitamaRailway</option>-->
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
        <div class="btn-group mx-auto mt-4" role="group" style="width: 100%;">
            <input type="submit" id="submit" name="submit" class="btn btn-success btn-lg col-5">
            <input type="reset" class="btn btn-primary col-5 btn-lg"name="クリア" onclick="resetValue()">
        </div>
    </form>
</div>

</div>
<?php include_once "includes/footer.inc.html";?>
