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


    <head>
        <meta content="text/php; charset=utf-8" http-equiv="Content-Type">
        <title>やますたぐらむ | 検索</title>

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
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
        <link rel="stylesheet" type="text/css" href="css/detail/slide_show.css">

    </head>
    <style>
    </style>

    <body>
        <br>
        <div class="row">
            <div class="col-9">
                <form action="10_search_results.php" method="post">
                    <input type="text" name="tiiki" class="localform_ymn form-control" placeholder="地域名で検索" rows="1" maxlength="100"></textarea>
            </div>
            <div class="col-3">
                <input type="submit" class="reserchsend_ymn sc47_ymn" value="送信">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <form action="10_search_results.php" method="post">
                    <input type="text" name="word" class="keywordform_ymn form-control" placeholder="キーワードで検索" rows="1" maxlength="100"></textarea>
            </div>
            <div class="col-3">

                <input type="submit" class="reserchsend_ymn sc58_ymn" value="送信" >
                </form>
            </div>
        </div>

        <p class="border_ymn"></p>
        <br>

        <?php

        $ps = $dbmng->post_select();

        echo '<form action="04_detail_post.php" method="post">
        <div class="row sc71_ymn">';
        $br_number = 0 ;
        foreach ($ps as $row) {
            //DBからファイルをとって移動展開zipファイルの削除ができる関数
            media_move($row['post_id'], $dbmng, $row['media1'], $row['media2'], $row['media3'], $row['media4']);

            //投稿に何個ファイルが投稿されているか調べる
            $files = glob('display/' . $row['post_id'] . '_*');
            $files_count = count($files);

            $file_display = 'display/' . $row['post_id'] . '_';

            //ここから表示する場所

            echo '<div class="seach-items sc85_ymn">
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