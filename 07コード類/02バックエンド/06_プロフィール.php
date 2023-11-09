<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>やますたぐるめ | プロフィール</title>

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
  <div class="row" style="margin:0px; padding:0px;">
    <div class="col-4" id="profile-icon_circle_nh"></div>
    <div class="col-5">
        <div id="user-id_nh">id:<?php echo $_SESSION['user']['id']; ?></div>
        <div id="follower_nh">
          <form action="14_フォロワー一覧.php" method="post">
            <button type="hidden" name="follownum" value="1" class="followernum_ymn">
              7
            </button>
          </form>
        </div>
        <div id="follower-text_nh">フォロワー</div>
    </div>
    <div class="col-3">
        <div>
            <button type="button" class="pfofile-editing-btn_nh" onclick="location.href='08_プロフィール編集.php'" style="background-color: #7dcfff;">編集</button>
        </div>
        <div id="follow_nh">
          <form action="13_フォロー一覧.php" method="post">
            <button type="hidden" name="follownum" value="2" class="follownum_ymn">
              17
            </button>
          </form>
        </div>
        <div id="follow-text_nh">フォロー</div>
    </div>
  </div>
  <!-- 
    //アイコン表示
    if (!empty($user_icon) || isset($user_icon)) { //設定している場合

        $base64_image = base64_encode($_SESSION['user']['icon']);

        echo '<br>' . '<img class="image_middle" width="250"src="data:image/jpeg;base64,' .  $base64_image . '" />　';
    } else { //設定してない場合
        echo '<img class="image_middle" src="img/pink.png">　';
    }
   -->
    <div id="user-name_nh"><?php echo $_SESSION['user']['name']; ?></div>
    <div class="profile-self-introduction_nh"><?php echo $_SESSION['user']['introduction']; ?></div>
    

      <div class="tab_container">
        <input id="tab1" type="radio" name="tab_item" checked>
        <label class="tab_item" for="tab1">投稿</label>
        <input id="tab2" type="radio" name="tab_item">
        <label class="tab_item" for="tab2">保存</label>
        <div class="tab_content" id="tab1_content">
          <div class="tab_content_description">
           <p>投稿</p>
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
          </div>
        </div>
        <div class="tab_content" id="tab2_content">
          <div class="tab_content_description">
            <p>保存</p>
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
          </div>
  
</body>
</html>