<?php
session_start();
include_once "includes/dbh.inc.php";
?>
<?php include_once "includes/header.inc.php";?>
<div class="container" style="width: 1000px">
    <h2 class="text-center" style="margin-bottom: 1em">ユーザ履歴</h2>
    <div class="container" style="width: 950px;height: 500px; overflow: auto;">
    <table class='table table-hover table-sm'>
        <?php
        if(isset($_SESSION["userName"])){
            if (isset($conn)) {
                $sql = "SELECT operator, line, origin, destination, date FROM users_history WHERE userid = {$_SESSION["userid"]} ORDER BY date DESC;";
                if($result = mysqli_query($conn, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            $operator = $row['operator'];
                            $line = $row['line'];
                            $origin = $row['origin'];
                            $destination = $row['destination'];
                            echo "<tr>";
                            echo "<td>{$row['date']}</td>";
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
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                }
            }
            mysqli_close($conn);
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