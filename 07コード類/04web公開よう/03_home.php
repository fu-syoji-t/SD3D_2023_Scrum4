<?php session_start();
//displayの中を全部消す　全部のファイルに書く
$folderPath = 'display/*';
foreach(glob($folderPath) as $file){
    if(is_file($file))
        unlink($file);
}
?>
<!DOCTYPE html>
<html class="html_ymn">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>やますたぐるめ | </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.4/css/all.css">
    <link href="css/nakai.css" rel="stylesheet" type="text/css">
    <link href="css/yamane.css" rel="stylesheet" type="text/css">
    <link href="css/yamanishi.css" rel="stylesheet" type="text/css">
    <link href="css/tomoyuki.css" rel="stylesheet" type="text/css">
    <link href="css/detail/menu.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <!--↓画像のスライドショーの時のみ-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="css/detail/slide_show.css">
</head>
<style>
    .menu_ymn {
        background: #ffffff;
        position: fixed;
        bottom: 0;
        z-index: 999;
    }

    .border_ymn {
        border-bottom: 2px solid #7DE5FF;
        text-decoration: none;
    }
</style>

<body class="html_ymn">

<?php
require 'DBManager_ys.php';
$dbmng = new DBManager();
include 'post_media.php';

//関数広場


//ここから表示準備
$ps = array();

$ps = $dbmng->post_select_user($_SESSION['user']['id']);

 foreach($ps as $row){

    $pss = array();
    $pss = $dbmng->user($row['user_id']);

    foreach($pss as $row2){
        $user_name = $row2['user_name'];
    }

    //DBからファイルをとって移動展開zipファイルの削除ができる関数
    media_move($row['post_id'],$dbmng,$row['media1'],$row['media2'],$row['media3'],$row['media4']);
    
    //投稿に何個ファイルが投稿されているか調べる
    $files = glob('display/'.$row['post_id'].'_*');
    $files_count = count($files);

    $file_display = 'display/'.$row['post_id'].'_';


    //ここから表示する場所
    echo '<div class="row" style="margin-top: 50px;">';
    //アイコンの記述

    $ps = $dbmng->user_icon($row['user_id']);
    foreach ($ps as $icon) {
      $icon_kari = $icon['icon'];
    }
    if (isset($icon_kari)) {

      $icon = $icon_kari;
      $base64_image = base64_encode($icon);
      echo '<div class="col-3"  id="profile-icon_circle_nh"><img style="border-radius: 50%; width:60px;height:60px;margin-left:20px;margin-bottom:10px;"width="250"src="data:image/jpeg;base64,' .  $base64_image . '" />　</div>
            <div class="col-9"style="position: relative;top:10px;left:-10px;">'.$user_name.'</div>';
    } else {
      echo '<div class="col-3" id="post-icon_circle_nh"></div>
            <div class="col-9">'.$user_name.'</div>';
    }
    /*<div class="col-3" id="post-icon_circle_nh"></div>*/
    echo '</div>
    <form action="04_detail_post.php" method="post" style="width: 30px;height: 350px;">

    <div style="text-align: center;">
        <div>
            <button type="hidden" name="post_id" class="home_detail_ys" value="'.$row['post_id'].'"></button>
            <ul class="slide-items">';
            if($files_count == 4){
        echo   '<li><img src="'.$file_display.'1.png'.'" height="350" alt=""></li>
                <li><img src="'.$file_display.'2.png'.'" height="350" alt=""></li>
                <li><img src="'.$file_display.'3.png'.'" height="350" alt=""></li>
                <li><img src="'.$file_display.'4.png'.'" height="350" alt=""></li>';
            }else if($files_count == 3){
        echo   '<li><img src="'.$file_display.'1.png'.'" height="350" alt=""></li>
                <li><img src="'.$file_display.'2.png'.'" height="350" alt=""></li>
                <li><img src="'.$file_display.'3.png'.'" height="350" alt=""></li>';
            }else if($files_count == 2){
        echo   '<li><img src="'.$file_display.'1.png'.'" height="350" alt=""></li>
                <li><img src="'.$file_display.'2.png'.'" height="350" alt=""></li>';
            }else if($files_count == 1){
        echo   '<li><img src="'.$file_display.'1.png'.'" height="350" alt=""></li>';
            }
    echo '</ul>
        </div>
    </div>
    </form>';

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
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <!--自作のJS-->
        <script src="js/slide_show.js"></script>
</body>

</html>