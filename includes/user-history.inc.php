
<?php
include_once "includes/dbh.inc.php";
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
            // Free result set
            mysqli_free_result($result);
        } else{
            echo "No records matching your query were found.";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);

