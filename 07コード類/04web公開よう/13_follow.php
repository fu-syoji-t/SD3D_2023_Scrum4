<?php
session_start();
if(isset($_POST['follownum'])){
    if ($_POST['follownum'] == 6) {
        $_SESSION['ff_transition'] = 'Location:06_profile.php';
    } else if ($_POST['follownum'] == 7) {
        $_SESSION['ff_transition'] = 'Location:07_profile_others.php';
    }
}
?>
<!DOCTYPE html>
<html class="html_ymn">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>やますたぐらむ | フォロー一覧</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.4/css/all.css">
    <link href="css/nakai.css" rel="stylesheet" type="text/css">
    <link href="css/yamane.css" rel="stylesheet" type="text/css">
    <link href="css/yamanishi.css" rel="stylesheet" type="text/css">
    <link href="css/tomoyuki.css" rel="stylesheet" type="text/css">
    <link href="css/detail/menu.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
</head>
<style>
</style>

<body class="body_ymn">
    <header class="header_ymn">
        <button type="button" class="chatback_ymn" onclick="location.href='ff_back.php'" value="遷移">く</button>
        <h5 class="dmname_ymn">フォロー</h5>
    </header>

    <?php

$pdo = new PDO('mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1417495-yamasuta;charset=utf8', 'LAA1417495', 'sotA1140');

    $sql = "SELECT * FROM follow WHERE user_id = ? ORDER BY follow_id";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1, $_SESSION['user']['id'], PDO::PARAM_INT);
    $ps->execute();
    $searchArray = $ps->fetchAll();

    foreach ($searchArray as $row) {
        $sql2 = "SELECT * FROM user WHERE user_id = ?";
        $ps2 = $pdo->prepare($sql2);
        $ps2->bindValue(1, $row['partner_id'], PDO::PARAM_INT);
        $ps2->execute();
        $searchArray2 = $ps2->fetchAll();

        foreach ($searchArray2 as $row2) {
            $partnaerid = $row2['user_id'];
            $partnername = $row2['user_name'];
            $iconmedia = $row2['icon'];

            // buttonのstyle直接書き込んでます
            echo '<div class="left_ymn" id="icon_circle_nh"></div>
                      <div class="ffname_ymn left_ymn">
                      <form action="07_profile_others.php" method="post">
                      <button type="hidden" name="user2" value="' . $partnaerid . '" class="userbtn_ymn ff">
                      <h6 class="ffname_ymn">' . $partnername. '</h6>
                      </button>
                      </form>
                      </div>
                      <div class="right_ymn">
                      <form action="ffupdate.php" method="post">
                      <button type="hidden" name="followbtn" value="13,' . $partnaerid . '" class="followbtn_ymn">フォローをやめる</a>
                      </form>
                      </div>
                      <br><br>
                      <p class="ffborder_ymn"></p>
                      <br>';
        }
    }
    ?>


<!--↓↓↓メニューバー-->
<div class="menu">
    <div class="home_menu">
      <button class="menu_botton">
        <img src="img/7_yamasutagourmet_home_logo.png" onclick="location.href='03_home.php'" width="78">
      </button>
    </div>

    <div class="search_menu">
      <button class="menu_botton">
        <img src="img/9_yamasutagourmet_search_logo.png" onclick="location.href='09_search.php'" width="78">
      </button>
    </div>

    <div class="newpost_menu">
      <button class="menu_botton">
        <img src="img/10_yamasutagourmet_new_post.png" onclick="location.href='05_new_post.php'" width="78">
      </button>
    </div>

    <div class="dm_menu">
      <button class="menu_botton">
        <img src="img/2_yamasutagourmet_.DM_logo.png" onclick="location.href='11_list_messages.php'" width="78">
      </button>
    </div>

    <div class="profile_menu">
      <button class="menu_botton">
        <img src="img/6_yamasutagourmet_profile_logo.png" onclick="location.href='06_profile.php'" width="78">
      </button>
    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!--自作のJS-->
    <script src="js/slide_show.js"></script>

</body>

</html>