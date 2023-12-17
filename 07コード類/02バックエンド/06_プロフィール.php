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
  <title>やますたぐるめ | プロフィール</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.4/css/all.css">
  <link href="../01フロントエンド/css/nakai.css" rel="stylesheet" type="text/css">
  <link href="../01フロントエンド/css/yamane.css" rel="stylesheet" type="text/css">
  <link href="../01フロントエンド/css/yamanishi.css" rel="stylesheet" type="text/css">
  <link href="../01フロントエンド/css/tomoyuki.css" rel="stylesheet" type="text/css">
  <link href="../01フロントエンド/css/detail/menu.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
</head>
<style>
</style>

<body>

  <?php
  $pdo = new PDO('mysql:host=localhost;dbname=yamasutagourmet;charset=utf8', 'root', 'root');

  $sql = "SELECT *, count(*) FROM follow WHERE partner_id = ?";
  $ps = $pdo->prepare($sql);
  $ps->bindValue(1, $_SESSION['user']['id'], PDO::PARAM_INT);
  $ps->execute();
  $searchArray = $ps->fetchAll();

  foreach ($searchArray as $row) {
    $followernumber = $row['count(*)']; // フォローされている行数を取得
  }

  $sql = "SELECT *, count(*) FROM follow WHERE user_id = ?";
  $ps = $pdo->prepare($sql);
  $ps->bindValue(1, $_SESSION['user']['id'], PDO::PARAM_INT);
  $ps->execute();
  $searchArray = $ps->fetchAll();

  foreach ($searchArray as $row) { // フォローしている行数を取得
    $follownumber = $row['count(*)'];
  }

  ?>

  <div class="row" style="margin:0px; padding:0px;">

    <?php //アイコンの記述

    $ps = $dbmng->user_icon($_SESSION['user']['id']);
    foreach ($ps as $icon) {
      $icon_kari = $icon['icon'];
    }
    if (isset($icon_kari)) {

      $icon = $icon_kari;
      $base64_image = base64_encode($icon);
      echo '<div class="col-3"  id="profile-icon_circle_nh"><img style="border-radius: 50%; width:70px;height:70px;margin-left:-12px;"width="250"src="data:image/jpeg;base64,' .  $base64_image . '" />　</div>';
    } else {
      echo '<div class="col-3" id="profile-icon_circle_nh"></div>';
    }
    ?>
    <div class="col-6">
      <div class="row">
        <div class="col-4">
          <div id="user-id_nh">id:<?php echo $_SESSION['user']['id']; ?></div>
        </div>
        <div class="col-8">
          <form action="logout.php" method="post">
            <button type="hidden" name="logout" value="<?php echo $_SESSION['user']['id']; ?>" 
              style="width: 90px;height: 33px;border-radius: 10px;border: none;color: #FFF;font-weight: bold;margin-top: 40px;margin-left: 30px;padding-bottom: 5px;background-color: #7dcfff;">ログアウト</button>
          </form>
        </div>
        <div id="follower_nh">
          <form action="14_フォロワー一覧.php" method="post">
            <button type="hidden" name="follownum" value="6" class="followernum_ymn">
              <?php echo $followernumber; ?>
            </button>
          </form>
        </div>
        <div id="follower-text_nh">フォロワー</div>
      </div>
    </div>
    <div class="col-3">
      <div>
        <button type="button" class="pfofile-editing-btn_nh" onclick="location.href='08_プロフィール編集.php'" style="background-color: #7dcfff;">編集</button>
      </div>
      <div id="follow_nh">
        <form action="13_フォロー一覧.php" method="post">
          <button type="hidden" name="follownum" value="6" class="follownum_ymn">
            <?php echo $follownumber; ?>
          </button>
        </form>
      </div>
      <div id="follow-text_nh">フォロー</div>
    </div>
  </div>

  <div id="user-name_nh"><?php echo $_SESSION['user']['name']; ?></div>
  <div class="profile-self-introduction_nh"><?php echo $_SESSION['user']['introduction']; ?></div>


  <div class="tab_container">
    <input id="tab1" type="radio" name="tab_item" checked>
    <label class="tab_item" for="tab1">投稿</label>
    <input id="tab2" type="radio" name="tab_item">
    <label class="tab_item" for="tab2">保存</label>
    <div class="tab_content" id="tab1_content">
      <div class="tab_content_description">
      <?php

    $ps = $dbmng->post_user();

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
      </div>
    </div>
    <div class="tab_content" id="tab2_content">
      <div class="tab_content_description">
      <?php

$ps = $dbmng->post_keep();

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
      </div>
    </div>
  </div>
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