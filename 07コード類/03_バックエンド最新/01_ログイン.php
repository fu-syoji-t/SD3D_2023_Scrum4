<!DOCTYPE html>
<html>

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>やますたぐらむ | ログイン</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.4/css/all.css">
    <link href="css/nakai.css" rel="stylesheet" type="text/css">
    <link href="css/yamane.css" rel="stylesheet" type="text/css">
    <link href="css/yamanishi.css" rel="stylesheet" type="text/css">
    <link href="css/tomoyuki.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
</head>
<style>
</style>
<body>

<div style="text-align: center;">
<h2 class="login_margin_top_ys">ログイン</h2>
<form action="login.php" method="post">
<input type="email" name="mail" class="input_login_ys form-control" placeholder="メールアドレス">
<input type="password" name="password" class="input_login_ys form-control" placeholder="パスワード"><br>
<p style="color:red;">
<?php
    session_start();

    if(!empty($_SESSION['error'])) {
        echo $_SESSION['error'];
    }
    
?>
</p>
<br><br>

<button type="submit" class="login-btn_ys">ログイン</button><br>
    </form>
    <a href="02_新規登録.php" class="login_atag_ys">→新規登録はこちら</a>

</div>
<div class="serch_user_ys"></div>
</body>
</html>