<?php
if (isset($_GET["error"])) {
    echo "<div class='text-center alert alert-danger ' role='alert'>";
    if($_GET["error"] == "emptyInput") {
        echo "入力してください";
    } else if ($_GET["error"] == "invalidUid") {
        echo "インバリッドユーザID";
    } else if ($_GET["error"] == "invalidEmail") {
        echo "インバリッドユーザメール";
    } else if ($_GET["error"] == "invalidPhoneNumber") {
        echo "インバリッド電話番号";
    } else if ($_GET["error"] == "pwdMatch") {
        echo "パスワードが合わない";
    } else if ($_GET["error"] == "userTaken") {
        echo "ユーザまたはメールはユーザー名は既に取られています";
    }else if ($_GET["error"]=="sameAs"){
        echo "発車駅と行先駅は異なければいけません";
    }else if ($_GET["error"]=="unavailable"){
        echo "選択不可";
    }else if($_GET["error"]=="wrongLogin") {
        echo "ユーザー名またはパスワードの入力に誤りがある";
    }else if ($_GET["error"]=="notFound"){
        echo "アクティブなアラームを見つけることができませんでした";
    }else if($_GET["error"]=="wrongPwd") {
        echo "間違えたパスワード";
    }
    echo "</div>";
}
if(isset($_GET["success"])) {
    echo "<div class='text-center alert alert-success' role='alert'>";
    if ($_GET["success"] == "regis") {
        echo "登録完了";
    }else if($_GET["success"]== "edit"){
        echo "編集完了";
    }
    echo "</div>";

}