<?php
session_start();
if(isset($_POST['follownum'])){
    if($_POST['follownum'] == 6){
        $_SESSION['ff_transition'] = 'Location:06_プロフィール.php';
    }else if($_POST['follownum'] == 7){
        $_SESSION['ff_transition'] = 'Location:07_他人プロフィール.php';
    }
}
?>
<!DOCTYPE html>
<html class="html_ymn">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>やますたぐらむ | フォロワー一覧</title>

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

<body class="body_ymn">
    <header class="header_ymn">
        <button type="button" class="chatback_ymn" onclick="location.href='ff_back.php'" value="遷移">く</button>
        <h5 class="dmname_ymn">フォロワー</h5>
    </header>

    <?php

    $pdo = new PDO('mysql:host=localhost;dbname=yamasutagourmet;charset=utf8', 'root', 'root');

    $sql = "SELECT * FROM follow WHERE partner_id = ? ORDER BY follow_id";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1, $_SESSION['user']['id'], PDO::PARAM_INT);
    $ps->execute();
    $searchArray = $ps->fetchAll();

    foreach ($searchArray as $row) {
        $sql2 = "SELECT * FROM user WHERE user_id = ?";
        $ps2 = $pdo->prepare($sql2);
        $ps2->bindValue(1, $row['user_id'], PDO::PARAM_INT);
        $ps2->execute();
        $searchArray2 = $ps2->fetchAll();

        foreach ($searchArray2 as $row2) {
            $partnerid = $row2['user_id'];
            $partnername = $row2['user_name'];
            $iconmedia = $row2['icon'];

            $sql3 = "SELECT *, count(*) FROM follow WHERE user_id = ? AND partner_id = ? ORDER BY follow_id";
            $ps3 = $pdo->prepare($sql3);
            $ps3->bindValue(1, $_SESSION['user']['id'], PDO::PARAM_INT);
            $ps3->bindValue(2, $row['user_id'], PDO::PARAM_INT);
            $ps3->execute();
            $searchArray3 = $ps3->fetchAll();

            foreach ($searchArray3 as $row3) {
                if ($row3['count(*)'] == 1) {

                    echo '<div class="left_ymn" id="icon_circle_nh"></div>
                        <div class="ffname_ymn left_ymn">
                        <form action="07_profile_others.php" method="post"style="height:50px;">
                        <button type="hidden" name="user2" value="' . $partnerid . '" class="userbtn_ymn ff">';
                        //アイコンチェック
                
                if (isset($row2['icon'])) {
                    $icon = $row2['icon'];
                    $base64_image = base64_encode($icon);    
                    echo '<div  id="profile-icon_circle_nh" style="text-align: left;">
                            <img class="img-10-icon" width="250"src="data:image/jpeg;base64,' .  $base64_image . '" />　</div>';
                }else {
                    echo '<div class="null-icon"></div>';
                }
                echo '<div style="position: relative;top:-50px;left:100px">' . $partnername. '</div>
                        </button>
                        </form>
                        </div>
                        <div class="right_ymn">
                        <form action="ffupdate.php" method="post"style="margin:0px;padding:0px;height:0px;">
                        <button type="hidden" name="followbtn" value="14,'.$partnerid.',2" class="followbtn_ymn"style="position: relative;top:-30px;left:220px">フォローをやめる</button>
                        </form>
                        </div>
                        <br><br>
                        <p class="ffborder_ymn"></p>
                        <br>';
                } else {
                    echo '<div class="left_ymn" id="icon_circle_nh"></div>
                        <div class="ffname_ymn left_ymn">
                        <form action="07_profile_others.php" method="post"style="height:50px;">
                        <button type="hidden" name="user2" value="' . $partnerid . '" class="userbtn_ymn ff">';
                        //アイコンチェック
                
                if (isset($row2['icon'])) {
                    $icon = $row2['icon'];
                    $base64_image = base64_encode($icon);    
                    echo '<div  id="profile-icon_circle_nh" style="text-align: left;">
                            <img class="img-10-icon" width="250"src="data:image/jpeg;base64,' .  $base64_image . '" />　</div>';
                }else {
                    echo '<div class="null-icon"></div>';
                }
                echo '<div style="position: relative;top:-50px;left:100px">' . $partnername. '</div>
                        </button>
                        </form>
                        </div>
                        <div class="right_ymn">
                        <form action="ffupdate.php" method="post"style="margin:0px;padding:0px;height:0px;">
                        <button type="hidden" name="followbtn" value="14,'.$partnerid.',1" class="nofollowbtn_ymn"style="position: relative;top:-30px;left:220px">フォローする</button>
                        </form>
                        </div>
                        <br><br>
                        <p class="ffborder_ymn"></p>
                        <br>';
                }
            }
        }
    }

    ?>

    <!--↓↓↓メニューバー-->
    <div class="menu">
        <div class="home_menu">
            <button class="menu_botton">
                <img src="img/やますたぐるめ_ホームロゴ.png" onclick="location.href='03_ホーム.php'" width="78">
            </button>
        </div>

        <div class="search_menu">
            <button class="menu_botton">
                <img src="img/やますたぐるめ_検索ロゴ.png" onclick="location.href='09_検索.php'" width="78">
            </button>
        </div>

        <div class="newpost_menu">
            <button class="menu_botton">
                <img src="img/やますたぐるめ_新規投稿ロゴ.png" onclick="location.href='05_新規投稿作成.php'" width="78">
            </button>
        </div>

        <div class="dm_menu">
            <button class="menu_botton">
                <img src="img/やますたぐるめ_.DMロゴ.png" onclick="location.href='11_メッセージ一覧.php'" width="78">
            </button>
        </div>

        <div class="profile_menu">
            <button class="menu_botton">
                <img src="img/やますたぐるめ_プロフィールロゴ.png" onclick="location.href='06_プロフィール.php'" width="78">
            </button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!--自作のJS-->
    <script src="js/slide_show.js"></script>

</body>
</html>