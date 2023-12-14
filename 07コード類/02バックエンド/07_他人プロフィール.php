<!DOCTYPE html>
<html>

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>やますたぐるめ | </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
    <?php

    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=yamasutagourmet;charset=utf8', 'root', 'root');

    $sql = "SELECT *, count(*) FROM follow WHERE partner_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1, $_POST['user2'], PDO::PARAM_INT);
    $ps->execute();
    $searchArray = $ps->fetchAll();

    foreach ($searchArray as $row) {
        $followernumber = $row['count(*)']; // フォローされている行数を取得
    }

    $sql = "SELECT *, count(*) FROM follow WHERE user_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1, $_POST['user2'], PDO::PARAM_INT);
    $ps->execute();
    $searchArray = $ps->fetchAll();

    foreach ($searchArray as $row) { // フォローしている行数を取得
        $follownumber = $row['count(*)'];
    }

    $sql = "SELECT * FROM user WHERE user_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1, $_POST['user2'], PDO::PARAM_INT);
    $ps->execute();
    $searchArray = $ps->fetchAll();

    foreach ($searchArray as $row) { // 受取ったuser_idの情報を取得
        $userid2 = $row['user_id'];
        $username2 = $row['user_name'];
        $userintroduction2 = $row['self_introduction'];
    }

    ?>

    <div class="row">
        <div class="col-4" id="profile-icon_circle_nh"></div>
        <div class="col-5">
            <div id="user-id_nh">id:<?php echo $userid2; ?></div>
            <div id="follower_nh"><?php echo $followernumber; ?></div>
            <div id="follower-text_nh">フォロワー</div>
        </div>
        <div class="col-3">
            <div id="another-follow_nh"><?php echo $follownumber; ?></div>
            <div id="another-follow-text_nh">フォロー</div>
        </div>
    </div>
    <div class="col-" id="user-name_nh"><?php echo $username2; ?></div>
    <div class="profile-self-introduction_nh"><?php echo $userintroduction2; ?></div>
        <div class="row">
            <div class="col-6">
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

                                echo '<form action="ffupdate.php" method="post">
                                <button type="hidden" name="followbtn" value="14,' . $partnerid . ',2" class="followbtn_ymn">フォローをやめる</button>
                                </form>';
                            } else {
                                echo '<form action="ffupdate.php" method="post">
                                <button type="hidden" name="followbtn" value="14,' . $partnerid . ',1" class="nofollowbtn_ymn">フォローする</button>
                                </form>';
                            }
                        }
                    }
                }

                ?>
                    
            </div>
    </form>
    <form action="12_チャット一覧.php" method="post">
        <div class="col-6">
            <?php echo '<button type="hidden" class="Parsonal-chat_nh" name="partner" value="' . $userid2 . '" style="background-color: #7dcfff;">チャット</button>
                    <input type="hidden" name="partner_name" value="' . $username2 . '"></button>'; ?>
        </div>
    </form>


    </div>
    <hr class="profile-line_nh">
    <div class="row">
        <div id="postphoto_nh"></div>
        <div id="postphoto_nh"></div>
        <div id="postphoto_nh"></div>
    </div>
    <div class="row">
        <div id="postphoto_nh"></div>
        <div id="postphoto_nh"></div>
        <div id="postphoto_nh"></div>
    </div>
    <div class="row">
        <div id="postphoto_nh"></div>
        <div id="postphoto_nh"></div>
        <div id="postphoto_nh"></div>
    </div>
    <div class="row">
        <div id="postphoto_nh"></div>
        <div id="postphoto_nh"></div>
        <div id="postphoto_nh"></div>
    </div>
    <div class="row">
        <div id="postphoto_nh"></div>
        <div id="postphoto_nh"></div>
        <div id="postphoto_nh"></div>
    </div>
</body>

</html>