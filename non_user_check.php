<?php
session_start();
include_once "add/header.add.php";
?>
<div class="container bg-white border rounded-3 mx-auto my-5 py-3" style="width: 500px">
    <h3 class="text-center">Alarm Check</h3>
    <?php include "add/error_handler.add.php";?>
    <form action="./includes/non_user_check.inc.php" method="post">
        <div class="form-group">
            <h4 class="my-2 text-center">Enter the registered Phonenumber</h4>
            <input type="text" class="input-group my-3" name="phone">
            <button type='submit' id='submit' name='submit' class='btn btn-primary mt-3'>送信</button>
        </div>
    </form>
</div>
<?php include_once "add/footer.add.html";?>
