<?php
session_start();
include_once "add/header.add.php";
include_once "access/dbh.access.php";
if($_SESSION["userName"]&&$_SESSION["alarm_date"]){
    header("location: alarm_countdown.php");
    exit();
}
?>
<div class="container bg-white border rounded-3 mt-3 pb-3" style="width: 500px">

    <div class="modal fade" id="fav_modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Favorites</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center fs-6">You can save up to five favorites.</p>
                    <table class="table table-hover table-sm table-responsive">
                        <thead>
                        <tr>
                            <th scope="col">Departure</th>
                            <th scope="col">Destination</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        <?php
                        if (isset($conn)) {
                            $cnt = 0;
                            $stmt = $conn->prepare("SELECT favid, operator, line, origin, destination
                                                  FROM users_favorites
                                                  WHERE usersid IN( SELECT usersid FROM users WHERE usersName = ?);");
                            $stmt -> bind_param('s',$_SESSION["userName"]);
                            $stmt -> execute();
                            if($result = $stmt->get_result()){//
                                if($result -> num_rows > 0){//
                                    while($row = $result->fetch_assoc()){
                                        $favId = $row['favid'];
                                        $operator = $row['operator'];
                                        $line = $row['line'];
                                        $origin = $row['origin'];
                                        $destination = $row['destination'];
                                        echo "<tr>";
                                        echo "<form action='./includes/alarm.inc.php' method='post'>";
                                        echo "<input name='operator' type='hidden' value='{$operator}'>";
                                        echo "<input name='train_line' type='hidden' value='{$operator}.{$line}'>";
                                        echo "<td><input name='origin' type='hidden' value='{$operator}.{$line}.{$origin}'>{$origin}</td>";
                                        echo "<td><input name='destination' type='hidden' value='{$operator}.{$line}.{$destination}'>{$destination}</td>";
                                        echo "<td><button type='submit' id='submit' name='submit' class='btn btn-outline-primary'>Send</button></td>";
                                        echo "</form>";
                                        echo "<form action='./includes/delete_favorite.inc.php' method='post'>";
                                        echo "<input type='hidden' name='id' value='{$favId}'>";
                                        echo "<td><button type='submit' id='submit' name='submit' class='btn btn-outline-danger'>Erase</button></td>";;
                                        echo "</form>";
                                        echo "</tr>";
                                        $cnt++;
                                    }
                                    $result -> free_result();
                                }
                            } else{
                                echo "ERROR: Could not able to execute $stmt. " . mysqli_error($conn);
                            }
                        }
                        mysqli_close($conn);
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <h1 class='text-center' style='padding: 1em;'>Alarm Setup</h1>
    <div id="error" class="text-center" style="color: red">
        <?php include_once "add/error_handler.add.php"; ?>
    </div>
    <form action="./includes/alarm.inc.php" method="post" name="alarm">
        <h3>Line Operator</h3>
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
            <h3>Line</h3>
            <select name="train_line" id="train_line" class="form-control form-select"  onchange="getStation()">
                <option value="" selected ></option>
            </select>
        </div>
        <div class="form-group">
            <h3>Departure</h3>
            <select name="origin" id="origin" class="form-control form-select" >
                <option value="" selected ></option>
            </select>
        </div>
        <div class="form-group">
            <h3>Destination</h3>
            <select name="destination" id="destination" class="form-control form-select" >
                <option value="" selected ></option>
            </select>
        </div>
        <?php if(isset($_SESSION["userName"]) ){
            if($cnt<5) {
                echo "<div class='form-check'>
            <input class='form-check-input' type='checkbox' id='fav' name='fav' name='set'>
            <label class='form-check-label' for='fav'>Favorite</label></div>";
            }
        }else{
            echo "<div class='form-group'>
                    <h3>Phonenumber(11 digits)</h3>
                    <input type='text' name='phone' class='input-group'></div>";
        }
        ?>
        <div class="btn-group mx-auto mt-4" role="group" style="width: 100%;">
            <input type="submit" id="submit" name="submit" value="送信"class="btn btn-success btn-lg col-5">
            <input type="reset" class="btn btn-primary col-5 btn-lg"value="Reset" 　name="Clear" onclick="resetValue()">
            <?php if(isset($_SESSION["userName"])) {
                echo "<button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#fav_modal'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-star' viewBox='0 0 16 16'>
                    <path d='M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z'/>
                </svg>
            </button>";
            }?>
    </form>
</div>
<?php include_once "add/footer.add.html";?>
