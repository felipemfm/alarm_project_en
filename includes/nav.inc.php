<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="image/icon.png" alt="" width="30" height="24" class="d-inline-block align-top">
            TrainAlarm</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <?php
                if(isset($_SESSION["userName"])) {
                    echo "<li class='nav-item'><a class='nav-link active' href='profile.php'>Profile</a></li>";
                    echo "<li class='nav-item'><a class='nav-link active' href='user_history.php'>History</a></li>";
                }
                ?>
            </ul>
        </div>
        <?php
        if(isset($_SESSION["userName"])) {
            echo "<a class='nav-link active nav-item justify-content-end' href='includes/logout.inc.php'>Logout</a>";
        }else{
            echo "<a class='nav-link active nav-item justify-content-end' href='login.php'>Login</a>";
        }
        ?>
    </div>
</nav>