<?php 
    session_start();
    require 'DBManager_ys.php';
    $dbmng = new DBManager();
    include 'post_media.php';
  //displayの中を全部消す　全部のファイルに書く
  $folderPath = 'display/*';
  foreach(glob($folderPath) as $file){
      if(is_file($file)){
          unlink($file);
      }
  } 
?>
<!DOCTYPE html>
<html>

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>やますたぐるめ | 他人プロフィール</title>

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

<body>
    <?php

    $pdo = new PDO('mysql:host=localhost;dbname=yamasutagourmet;charset=utf8', 'root', 'root');

    if (isset($_POST['user2'])) {

        $user2 = $_POST['user2'];
    } else if (isset($_GET['followbtn'])) {

        $user2 = $_GET['followbtn'];
    }

    $sql = "SELECT *, count(*) FROM follow WHERE partner_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1, $user2, PDO::PARAM_INT);
    $ps->execute();
    $searchArray = $ps->fetchAll();

    foreach ($searchArray as $row) {
        $followernumber = $row['count(*)']; // フォローされている行数を取得
    }

    $sql = "SELECT *, count(*) FROM follow WHERE user_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1, $user2, PDO::PARAM_INT);
    $ps->execute();
    $searchArray = $ps->fetchAll();

    foreach ($searchArray as $row) { // フォローしている行数を取得
        $follownumber = $row['count(*)'];
    }

    $sql = "SELECT * FROM user WHERE user_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1, $user2, PDO::PARAM_INT);
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
    <br>
    <div class="row">
        <div class="col-6">
            <?php

            $sql = "SELECT * FROM user WHERE user_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $row['user_id'], PDO::PARAM_INT);
            $ps->execute();
            $searchArray = $ps->fetchAll();

            foreach ($searchArray as $row) {

                $partnerid = $row['user_id'];
                $partnername = $row['user_name'];
                $iconmedia = $row['icon'];
            }

            $sql = "SELECT *, count(*) FROM follow WHERE user_id = ? && partner_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $_SESSION['user']['id'], PDO::PARAM_INT);
            $ps->bindValue(2, $user2, PDO::PARAM_INT);
            $ps->execute();
            $searchArray = $ps->fetchAll();

            foreach ($searchArray as $row) {

            if($_SESSION['user']['id'] == $_POST['user2']){  
                
            }else if ($row['count(*)'] != 0) {

                    echo '<form action="ffupdate2.php" method="post">
                        <button type="hidden" name="followbtn" value="14,' . $partnerid . ',2" class="followbtn_ymn">フォローをやめる</button>
                        </form>';
                } else {

                    echo '<form action="ffupdate2.php" method="post">
                                <button type="hidden" name="followbtn" value="14,' . $partnerid . ',1" class="nofollowbtn_ymn">フォローする</button>
                                </form>';
                }
            }

            ?>

        </div>
        </form>

        <div class="col-6">
            <form action="12_チャット一覧.php" method="post">
                <?php
                echo '<button type="hidden" class="Parsonal-chat_nh" name="partner" value="' . $userid2 . '" style="background-color: #7dcfff;">チャット</button>
                    <input type="hidden" name="partner_name" value="' . $username2 . '"></button>';
                ?>
            </form>
        </div>

    </div>
    <hr class="profile-line_nh">
    <?php

$ps = $dbmng->post_tanin($_POST['user2']);

echo '<form action="04_投稿詳細.php" method="post"><div class="row" style="margin-left:10px;">';
$br_number = 0 ;
foreach ($ps as $row) {
    //DBからファイルをとって移動展開zipファイルの削除ができる関数
    media_move($row['post_id'], $dbmng, $row['media1'], $row['media2'], $row['media3'], $row['media4']);

    //投稿に何個ファイルが投稿されているか調べる
    $files = glob('display/' . $row['post_id'] . '_*');
    $files_count = count($files);

    $file_display = 'display/' . $row['post_id'] . '_';

    //ここから表示する場所

    echo '<div class="seach-items" style="margin-bottom:10px;">
    <button type="hidden" name="post_id" class="seach_detail_ys" value="' . $row['post_id'] . '"></button>
    <img src="' . $file_display . '1.png' . '" height="110" alt="">
    </div><br>';
    if($br_number %3 == 0){
        echo '<br>';
    }
    $br_number = $br_number + 1;
}
echo '</div>
        </form>';
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
</body>

</html>