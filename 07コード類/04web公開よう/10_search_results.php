<!--<!DOCTYPE.php>
.php class=.php_ymn">-->
<?php
    require 'DBManager_ys.php';
    $dbmng = new DBManager();
    include 'post_media.php';
//displayの中を全部消す　全部のファイルに書く
$folderPath = 'display/*';
foreach (glob($folderPath) as $file) {
    if (is_file($file))
        unlink($file);
}
?>

<head>
    <meta content="text.php; charset=utf-8" http-equiv="Content-Type">
    <title>やますたぐらむ | 検索結果</title>

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
    <!--↓画像のスライドショーの時のみ-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="css/detail/slide_show.css">

</head>
<style>
</style>

<body class="body_ymn">

    <header class="header_ymn">
        <button type="button" class="chatback_ymn" onclick="location.href='09_search.php'" value="遷移">く</button>
        <h5><br>　　　　 検索結果</h5>
    </header>

    </div>
    <?php

    if (isset($_POST['tiiki'])) { //地域検索した場合
        $ps = $dbmng->search_tiki($_POST['tiiki']);

        echo '<form action="04_detail_post.php" method="post"><div class="row margin-le10">';

        foreach ($ps as $row) {
            //DBからファイルをとって移動展開zipファイルの削除ができる関数
            media_move($row['post_id'], $dbmng, $row['media1'], $row['media2'], $row['media3'], $row['media4']);

            //投稿に何個ファイルが投稿されているか調べる
            $files = glob('display/' . $row['post_id'] . '_*');
            $files_count = count($files);

            $file_display = 'display/' . $row['post_id'] . '_';

            //ここから表示する場所

            echo '<div class="seach-items margin-bo10">
            <button type="hidden" name="post_id" class="seach_detail_ys" value="' . $row['post_id'] . '"></button>
            <img src="' . $file_display . '1.png' . '" height="110" alt="">
            </div>';
        }
        echo '</div>
                </form>';

    } else if (isset($_POST['word'])) {

        //ユーザーIDが一致すればユーザーも表示する
        $ps = $dbmng->search_user($_POST['word']);
        if (isset($ps)) {
            foreach ($ps as $row) {
                //アイコンチェック
                echo '<form action="07_profile_others.php" method="post" class="margin-0">
                        <button type="hidden" class="search_user_ys" name="user2" value="'.$row['user_id'].'">';
                if (isset($row['icon'])) {
                    $icon = $row['icon'];
                    $base64_image = base64_encode($icon);
                    echo '<div  id="profile-icon_circle_nh" style="text-align: left;">
                            <img class="img-10-icon" width="250"src="data:image/jpeg;base64,' .  $base64_image . '" />　</div>';
                }else {
                    echo '<div class="null-icon"></div>';
                }
                echo '<div id="search_username_ys">'.$row['user_name'] . '</div>
                        </button>
                        </form>
                        </div>
                        <hr>';
            }
        }
        //ワード検索した場合　投稿表示
        $ps = $dbmng->search_word($_POST['word']);

        echo '<form action="04_detail_post.php" method="post"><div class="row margin-le10">';

        foreach ($ps as $row) {
            //DBからファイルをとって移動展開zipファイルの削除ができる関数
            media_move($row['post_id'], $dbmng, $row['media1'], $row['media2'], $row['media3'], $row['media4']);

            //投稿に何個ファイルが投稿されているか調べる
            $files = glob('display/' . $row['post_id'] . '_*');
            $files_count = count($files);

            $file_display = 'display/' . $row['post_id'] . '_';

            //ここから表示する場所

            echo '<div class="seach-items margin-bo10">
            <button type="hidden" name="post_id" class="seach_detail_ys" value="' . $row['post_id'] . '"></button>
            <img src="' . $file_display . '1.png' . '" height="110" alt="">
            </div>';
        }
        echo '</div>
            </form>';

    } else if (isset($_POST['tag'])) { //ハッシュタグ検索
        //echo $_POST['tag'];
        //ハッシュタグを押した場合　投稿表示
        $ps = $dbmng->search_tag($_POST['tag']);

        echo '<form action="04_detail_post.php" method="post"><div class="row margin-le10">';

        foreach ($ps as $row) {
            //DBからファイルをとって移動展開zipファイルの削除ができる関数
            media_move($row['post_id'], $dbmng, $row['media1'], $row['media2'], $row['media3'], $row['media4']);

            //投稿に何個ファイルが投稿されているか調べる
            $files = glob('display/' . $row['post_id'] . '_*');
            $files_count = count($files);

            $file_display = 'display/' . $row['post_id'] . '_';

            //ここから表示する場所

            echo '<div class="seach-items margin-bo10">
            <button type="hidden" name="post_id" class="seach_detail_ys" value="' . $row['post_id'] . '"></button>
            <img src="' . $file_display . '1.png' . '" height="110" alt="">
            </div>';
        }
        echo '</div>
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
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<!--自作のJS-->
<script src="js/slide_show.js"></script>

</html>
<!--<.php>-->