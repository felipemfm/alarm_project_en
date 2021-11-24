<?php
session_start();
if(!isset($_SESSION["userName"])){
    header("location: index.php");
    exit();
}
?>
<?php include_once "add/header.add.php";?>

<div class="container bg-white border rounded-3 mt-5 pb-3" style="width: 500px">
    <h1 class="text-center" style="margin: 1em;">Profile Edit</h1>
    <?php include_once "add/error_handler.add.php" ?>
    <form action="includes/profile.inc.php" method="post">
        <div class="form-group ">
            <h2>Email/h2>
            <input type="text" name="email" class="form-control" >
            <button class="btn btn-primary my-3" type="submit" name="submit">Edit</button>
        </div>
    </form>
    <form action="includes/profile.inc.php" method="post">
        <div class="form-group ">
            <h2>Phonenumber</h2>
            <input type="text" name="phoneNumber" class="form-control" >
            <button class="btn btn-primary my-3" type="submit" name="submit">edit</button>
        </div>
    </form>
    <form action="includes/profile.inc.php" method="post">
        <div class="form-group ">
            <h2>Password</h2>
            <p>New Password</p>
            <input type="password" name="newPwd" class="form-control" >
            <p>New Password Confirmation</p>
            <input type="password" name="newPwdRepeat" class="form-control">
            <p>Current Password</p>
            <input type="password" name="pwd" class="form-control" >
            <button class="btn btn-primary mt-3" type="submit" name="submit">編集</button>
        </div>
    </form>
</div>
<?php include_once "add/footer.add.html";?>
</html>
