<!DOCTYPE html>
<html>

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>やますたぐらむ | 新規登録</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.4/css/all.css">
    <link href="../01フロントエンド/css/nakai.css" rel="stylesheet" type="text/css">
    <link href="../01フロントエンド/css/yamane.css" rel="stylesheet" type="text/css">
    <link href="../01フロントエンド/css/yamanishi.css" rel="stylesheet" type="text/css">
    <link href="../01フロントエンド/css/tomoyuki.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
</head>
<style>
</style>

<body>
  <div class="shinki_ft">
    <h4>
        新規登録
    </h4>
  </div>
  <div class="container" style="text-align: center;">
    <div class="row">
      <div class="col-3"></div>
        <form action="newlogin.php" method="post">
        <input type="email" name="mail_login" class="input_shinki_ft form-control" placeholder="メールアドレス">
    <input type="password" name="pass_login" class="input_shinki_ft form-control" placeholder="パスワード">
    <input type="username" name="user_login" class="input_shinki_ft form-control" placeholder="ユーザーネーム"><br>
        <?php
           session_start();
           if((isset($_SESSION['error']))){
            echo '<div style="color: red; text-align: center;">'.$_SESSION['error'].'</div>';
            unset($_SESSION['error']);
            }
        ?>
            <div class="col-3"></div>
    </div>
    <input type="submit" class="shinki-btn_ft" value="新規登録"><br>
    <a class="url_ft" href="01_ログイン.php">→ログインへ戻る</a>
    </form>
</div>
</body>
</html>