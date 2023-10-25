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
/*
require 'DBManager_ys.php';
$dbmng = new DBManager();
$ps = array();

$ps = $dbmng->user_search();
 foreach($ps as $row ){
echo    '<div class="row" style="margin-top: 50px;">
        <div class="col-3" id="post-icon_circle_nh"></div>
        <div class="col-9">'.$row['user_name'].'</div>
    </div>
    <form action="04_投稿詳細.html" method="post" style="width: 350px;height: 350px;">

        <div style="text-align: center;">
            <div>
                <button type="hidden" class="home_detail_ys"></button>
                <ul class="slide-items">
                    <li><img src="img/やますたぐるめ_.DMロゴ.png" height="350" alt=""></li>
                    <li><img src="img/やますたぐるめ_プロフィールロゴ.png" height="350" alt=""></li>
                    <li><img src="img/プリクラ.png" height="350" alt=""></li>
                    <li><img src="img/プリクラ.png" height="350" alt=""></li>
                </ul>
            </div>
        </div>
    </form>';
 }*/



//↓完成しなかった時の最終手段
require 'DBManager_ys.php';
$dbmng = new DBManager();
$ps = array();

$ps = $dbmng->post();

 foreach($ps as $row){

    $pss = array();
    $pss = $dbmng->user($row['user_id']);
    foreach($pss as $roww){
        $user_name = $roww['user_name'];
    }

echo    '<div class="row" style="margin-top: 50px;">
        <div class="col-3" id="post-icon_circle_nh"></div>
        <div class="col-9">'.$user_name.'</div>
    </div>
    <form action="04_投稿詳細.html" method="post" style="width: 350px;height: 350px;">

        <div style="text-align: center;">
            <div>
                <button type="hidden" class="home_detail_ys"></button>
                <ul class="slide-items">';
                if(isset($row['media4'])){
            echo   '<li><img src="'.$row['media1'].'" height="350" alt=""></li>
                    <li><img src="'.$row['media2'].'" height="350" alt=""></li>
                    <li><img src="'.$row['media3'].'" height="350" alt=""></li>
                    <li><img src="'.$row['media4'].'" height="350" alt=""></li>';
                }else if(isset($row['media3'])){
            echo   '<li><img src="'.$row['media1'].'" height="350" alt=""></li>
                    <li><img src="'.$row['media2'].'" height="350" alt=""></li>
                    <li><img src="'.$row['media3'].'" height="350" alt=""></li>';
                }else if(isset($row['media2'])){
            echo   '<li><img src="'.$row['media1'].'" height="350" alt=""></li>
                    <li><img src="'.$row['media2'].'" height="350" alt=""></li>';
                }else{
            echo   '<li><img src="'.$row['media1'].'" height="350" alt=""></li>';
                }
echo                '</ul>
            </div>
        </div>
    </form>';
 }
?>



    <!--↓↓↓メニューバー-->
    <div id="wrapper_ymn">

        <div class="menu_ymn">
            <p class="border_ymn" style="margin: 0px;"></p>
            <div class="row footer_ymn" style="padding-left:35px;">
                <div class="col-2" style="padding:0px;text-align: center;">
                    <form action="03_ホーム.html" method="post">
                        <button name="homelogo" type="hidden" value="1"
                            style="text-decoration: none; background-color: transparent; border: none; outline: none; box-shadow: none;">
                            <img src="img/やますたぐるめ_ホームロゴ.png" width="78">
                        </button>
                    </form>
                </div>
                <div class="col-2" style="padding:0px;text-align: center;">
                    <form action="09_検索.html" method="post">
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
                    <form action="11_メッセージ一覧.html" method="post">
                        <button name="homelogo" type="hidden" value="1"
                            style="text-decoration: none; background-color: transparent; border: none; outline: none; box-shadow: none;">
                            <img src="img/やますたぐるめ_.DMロゴ.png" width="78">
                        </button>
                    </form>
                </div>
                <div class="col-2" style="padding:0px;text-align: center;">
                    <form action="06_プロフィール.html" method="post">
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