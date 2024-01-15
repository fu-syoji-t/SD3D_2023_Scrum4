<?php
session_start();
require 'DBManager_ys.php';
$dbmng = new DBManager();
include 'post_media.php';
//displayの中を全部消す　全部のファイルに書く
$folderPath = 'display/*';
foreach (glob($folderPath) as $file) {
  if (is_file($file)) {
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
  $pdo = new PDO('mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1417495-yamasuta;charset=utf8', 'LAA1417495', 'sotA1140');

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

  <div class="row">

    <?php //アイコンの記述

    $ps = $dbmng->user_icon($row['user_id']);
    foreach ($ps as $icon) {
      $icon_kari = $icon['icon'];
    }
    if (isset($icon_kari)) {

      $icon = $icon_kari;
      $base64_image = base64_encode($icon);
      echo '<div class="col-3"  id="profile-icon_circle_nh">
          <img class="proicon_ymn" width="250"src="data:image/jpeg;base64,' .  $base64_image . '" />　</div>';
    } else {
      echo '<div class="col-3 pronoicon_ymn" width="250"></div>';
    }
    
    ?>

    <div class="col-6">
      <div class="row">
        <div class="col-4">
          <div id="user-id_nh">id:<?php echo $_SESSION['user']['id']; ?></div>
        </div>
        <div class="col-8">
          <form action="logout.php" method="post">
            <button type="hidden" class="logoutbtn_ymn" name="logout" value="<?php echo $_SESSION['user']['id']; ?>"style="padding:0px;">ログアウト</button>
          </form>
        </div>
        
          <form action="14_followers.php" method="post">
            <button type="hidden" name="follownum" value="6" class="followernum_ymn"style="color:black">
              <div class="pro96_ymn">
            <div class="pro97_ymn">フォロワー</div>
              <div class="pro98_ymn"><?php echo $followernumber; ?></div>
              </div>
            </button>
          </form>


      </div>
    </div>
    <div class="col-3">
      <div>
        <button type="button" class="pfofile-editing-btn_nh pro108_ymn" onclick="location.href='08_profile_editing.php'"style="padding:0px">編集</button>
      </div>
     
        <form action="13_follow.php" method="post">
          <button type="hidden" name="follownum" value="6" class="follownum_ymn"style="color:black">
          <div class="pro113_ymn">
          <div class="pro114_ymn">フォロー</div>
            <div class="pro115_ymn"><?php echo $follownumber; ?></div>
          </div>
          </button>
        </form>

    </div>
  </div>

  <div id="user-name_nh"><?php echo $_SESSION['user']['name']; ?></div>
  <div class="profile-self-introduction_nh"><?php echo $_SESSION['user']['introduction']; ?></div>
  <br>

  <div class="tab_container">
    <input id="tab1" type="radio" name="tab_item" checked>
    <label class="tab_item" for="tab1">投稿</label>
    <input id="tab2" type="radio" name="tab_item">
    <label class="tab_item" for="tab2">保存</label>
    <div class="tab_content" id="tab1_content">
      <div class="tab_content_description">
        <?php

        $ps = $dbmng->post_user();

        echo '<form action="04_detail_post.php" method="post">
        <div class="row pro138_ymn">';
        $br_number = 0;
        foreach ($ps as $row) {
          //DBからファイルをとって移動展開zipファイルの削除ができる関数
          media_move($row['post_id'], $dbmng, $row['media1'], $row['media2'], $row['media3'], $row['media4']);

          //投稿に何個ファイルが投稿されているか調べる
          $files = glob('display/' . $row['post_id'] . '_*');
          $files_count = count($files);

          $file_display = 'display/' . $row['post_id'] . '_';

          //ここから表示する場所

          echo '<div class="seach-items pro153_ymn">
        <button type="hidden" name="post_id" class="seach_detail_ys" value="' . $row['post_id'] . '"></button>
        <img src="' . $file_display . '1.png' . '" height="110" alt="">
        </div><br>';
          if ($br_number % 3 == 0) {
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

        echo '<form action="04_detail_post.php" method="post">
        <div class="row pro174_ymn">';
        $br_number = 0;
        foreach ($ps as $row) {
          //DBからファイルをとって移動展開zipファイルの削除ができる関数
          media_move($row['post_id'], $dbmng, $row['media1'], $row['media2'], $row['media3'], $row['media4']);

          //投稿に何個ファイルが投稿されているか調べる
          $files = glob('display/' . $row['post_id'] . '_*');
          $files_count = count($files);

          $file_display = 'display/' . $row['post_id'] . '_';

          //ここから表示する場所

          echo '<div class="seach-items pro188_ymn">
          <button type="hidden" name="post_id" class="seach_detail_ys" value="' . $row['post_id'] . '"></button>
          <img src="' . $file_display . '1.png' . '" height="110" alt="">
          </div><br>';
          if ($br_number % 3 == 0) {
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
</body>

</html>