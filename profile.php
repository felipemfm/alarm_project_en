<?php
session_start();
if(!isset($_SESSION["userName"])){
    header("location: index.php");
    exit();
}
?>
<?php include_once "add/header.add.php";?>
<div class="container bg-white border rounded-3 mt-5" style="width: 500px">
    <h1 class="text-center my-5">User Profile</h1>
    <div class="row">
        <div class="col-sm">
            <h3 class="text-start fw-bold">User ID:</h3>
        </div>
        <div class="col-sm">
            <h3 class="text-end"><?php echo $_SESSION["userName"];?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <h3 class="text-start fw-bold">Email:</h3>
        </div>
        <div class="col-sm">
            <h3 class="text-end"><?php echo $_SESSION["userEmail"];?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <h3 class="text-start fw-bold">Phonenumber:</h3>
        </div>
        <div class="col-sm">
            <h3 class="text-end"><?php echo $_SESSION["userPhoneNumber"];?></h3>
        </div>
    </div>
    <div class="d-grid gap-2">
        <button type="button" class="btn btn-secondary btn-lg" style="margin: 2em 0;" onclick="location.href='profile_edit.php'">
            Edit Information
        </button>
    </div>
</div>
<?php include_once "add/footer.add.html";?>
