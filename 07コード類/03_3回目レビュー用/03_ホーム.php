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
    <link href="../01フロントエンド/css/nakai.css" rel="stylesheet" type="text/css">
    <link href="../01フロントエンド/css/yamane.css" rel="stylesheet" type="text/css">
    <link href="../01フロントエンド/css/yamanishi.css" rel="stylesheet" type="text/css">
    <link href="../01フロントエンド/css/tomoyuki.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <!--↓画像のスライドショーの時のみ-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="../01フロントエンド/css/detail/slide_show.css">
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
      echo '<div class="col-3"  id="profile-icon_circle_nh"><img style="border-radius: 50%; width:60px;height:60px;margin-left:20px;margin-bottom:20px;"width="250"src="data:image/jpeg;base64,' .  $base64_image . '" />　</div>';
    } else {
      echo '<div class="col-3" id="post-icon_circle_nh"></div>';
    }
    /*<div class="col-3" id="post-icon_circle_nh"></div>*/
    echo '<div class="col-9">'.$user_name.'</div>
    </div>
    <form action="04_投稿詳細.php" method="post" style="width: 350px;height: 350px;">

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



    <!--メニューバー-->
    <div id="wrapper_ymn">

        <div class="menu_ymn">
            <p class="border_ymn" style="margin: 0px;"></p>
            <div class="row footer_ymn" style="padding-left:35px;">
                <div class="col-2" style="padding:0px;text-align: center;">
                    <form action="03_ホーム.php" method="post">
                        <button name="homelogo" type="hidden" value="1"
                            style="text-decoration: none; background-color: transparent; border: none; outline: none; box-shadow: none;">
                            <img src="img/やますたぐるめ_ホームロゴ.png" width="78">
                        </button>
                    </form>
                </div>
                <div class="col-2" style="padding:0px;text-align: center;">
                    <form action="09_検索.php" method="post">
                        <button name="homelogo" type="hidden" value="1"
                            style="text-decoration: none; background-color: transparent; border: none; outline: none; box-shadow: none;">
                            <img src="img/やますたぐるめ_検索ロゴ.png" width="78">
                        </button>
                    </form>
                </div>
                <div class="col-2" style="padding:0px;text-align: center;">
                    <form action="05_新規投稿作成.php" method="post">
                        <button name="homelogo" type="hidden" value="1"
                            style="text-decoration: none; background-color: transparent; border: none; outline: none; box-shadow: none;">
                            <img src="img/やますたぐるめ_新規投稿ロゴ.png" width="78">
                        </button>
                    </form>
                </div>
                <div class="col-2" style="padding:0px;text-align: center;">
                    <form action="11_メッセージ一覧.php" method="post">
                        <button name="homelogo" type="hidden" value="1"
                            style="text-decoration: none; background-color: transparent; border: none; outline: none; box-shadow: none;">
                            <img src="img/やますたぐるめ_.DMロゴ.png" width="78">
                        </button>
                    </form>
                </div>
                <div class="col-2" style="padding:0px;text-align: center;">
                    <form action="06_プロフィール.php" method="post">
                        <button name="homelogo" type="hidden" value="1"
                            style="text-decoration: none; background-color: transparent; border: none; outline: none; box-shadow: none;">
                            <img src="img/やますたぐるめ_プロフィールロゴ.png" width="78">
                        </button>
                    </form>
                </div>
                <div class="col-1" style="padding:0px"></div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <!--自作のJS-->
        <script src="../01フロントエンド/js/slide_show.js"></script>
</body>

</html>