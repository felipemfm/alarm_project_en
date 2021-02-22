<?php
session_start();
include_once "includes/dbh.inc.php";
?>
<?php include_once "includes/header.inc.php";?>
<div class="container bg-white border rounded-3 mt-3" style="width: 1000px">
    <h2 class="text-center" style="margin-bottom: 1em">ユーザ履歴</h2>
    <div class="container" style="width: 950px;height: 500px; overflow: auto;">
        <table class='table table-hover table-sm table-responsive'>
            <div>
            <thead class="sticky-top">
            <tr class="bg-light">
                <th scope="col">日付</th>
                <th scope="col">鉄道会社</th>
                <th scope="col">線路</th>
                <th scope="col">発車駅</th>
                <th scope="col">行先駅</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($_SESSION["userName"])){
                if (isset($conn)) {
                    $stmt = $conn->prepare("SELECT operator, line, origin, destination, date FROM users_history WHERE usersid IN( SELECT usersid FROM users WHERE usersName = ?)");
                    $stmt -> bind_param('s',$_SESSION["userName"]);
                    $stmt -> execute();
                    if($result = $stmt->get_result()){
//                    if(mysqli_num_rows($result) > 0){
                        if($result -> num_rows > 0){
//                        while($row = mysqli_fetch_array($result)){
                            while($row = $result->fetch_assoc()){
                                $operator = $row['operator'];
                                $line = $row['line'];
                                $origin = $row['origin'];
                                $destination = $row['destination'];
                                echo "<tr>";
                                echo "<td scope='row'>{$row['date']}</td>";
                                echo "<form action='./includes/alarm.inc.php' method='post'>";
                                echo "<td><input name='operator' type='hidden' value='{$operator}'>{$operator}</td>";
                                echo "<td><input name='train_line' type='hidden' value='{$operator}.{$line}'>{$line}</td>";
                                echo "<td><input name='origin' type='hidden' value='{$operator}.{$line}.{$origin}'>{$origin}</td>";
                                echo "<td><input name='destination' type='hidden' value='{$operator}.{$line}.{$destination}'>{$destination}</td>";
                                echo "<td><button type='submit' id='submit' name='submit' class='btn btn-outline-primary'>Send</button></td>";
                                echo "</form>";
                                echo "</tr>";
                            }
                            mysqli_free_result($result);
                        } else{
                            echo "No records matching your query were found.";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $stmt. " . mysqli_error($conn);
                    }
                }
                mysqli_close($conn);
            }else{
                header("location: index.php");
                exit();
            }?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once "includes/footer.inc.html";?>
</html>