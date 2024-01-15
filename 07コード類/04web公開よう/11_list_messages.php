<?php
session_start();
$pdo = new PDO('mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1417495-yamasuta;charset=utf8', 'LAA1417495', 'sotA1140');

if (isset($_SESSION['partner_name']) && isset($_SESSION['partner_id'])) {
unset($_SESSION['partner_id']);
unset($_SESSION['partner_name']);
  /*$_SESSION['partner_id'] = array();
  $_SESSION['partner_id'] = array();*/
}
require 'DBManager_ys.php';
$dbmng = new DBManager();
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
  <title>やますたぐるめ | </title>

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
  <div class="message_nh">
    <div class="container-fluid">
      <h1>Message</h1>
    </div>
    <hr class="meinline_nh">
  </div>

  <div class="row">

    <?php
    $ps = $dbmng->dm_list_select($_SESSION['user']['id']);

    foreach($ps as $row){
      //相手のユーザーidを取得
      if($_SESSION['user']['id'] != $row['user_id1']){
        $partner_id = $row['user_id1'];
      }else if($_SESSION['user']['id'] != $row['user_id2']){
        $partner_id = $row['user_id2'];
      }
      
      $partner_ps = $dbmng->user($partner_id);

      foreach ($partner_ps as $row2) {
        $partner_name = $row2['user_name'];
        $icon = $row2['icon'];
      }

      echo '<form action="12_chat.php" method="post" class="padding-0"> ';
      echo'<button type="hidden" class="button-11dm" value="'.$partner_id.'" name="partner">';
      // アイコンの記述
      // アイコンが存在してるか検索
      if(isset($icon)){

        $base64_image = base64_encode($icon);
        echo '<div class="col-3" >
          <img class="icon" width="250"src="data:image/jpeg;base64,' .  $base64_image . '" />　</div>
          <div class="name11" style="color:black;position: relative;top:-70px;">'.$partner_name.'</div>';

      }else{
        echo '<div class="col-3 null-icon" ></div>
        <div class="name11"style="color:black;position: relative;top:-70px;">'.$partner_name.'</div>';
      }

      //既読機能
     /* if ($row['dm_read'] != $_SESSION['user']['id'] && $row['dm_read'] != 0) {
        echo  '<div  id="notice_circle_nh"></div>';
      }*/

      echo'</button>
      </form>
      <hr class="hr-dm">';
    }

    ?>
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
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <!--自作のJS-->
  <script src="js/slide_show.js"></script>
</body>

</html>