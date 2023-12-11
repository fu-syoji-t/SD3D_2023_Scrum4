<?php session_start() ?>
<!DOCTYPE>
<php class="php_ymn">

    <head>
        <meta content="text/php; charset=utf-8" http-equiv="Content-Type">
        <title>やますたぐらむ | 検索</title>

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
        <div class="row">
            <div class="col-9">
                <form action="10_検索結果.php" method="post">
                    <textarea name="tiiki" class="localform_ymn" placeholder="地域名で検索" rows="1" maxlength="100"></textarea>
            </div>
            <div class="col-3">
                <input type="submit" class="reserchsend_ymn" value="送信" style="background-color: #7dcfff;">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <form action="10_検索結果.php" method="post">
                    <textarea name="word" class="keywordform_ymn" placeholder="キーワードで検索" rows="1" maxlength="100"></textarea>
            </div>
            <div class="col-3">

                <input type="submit" class="reserchsend_ymn" value="送信" style="background-color: #7dcfff;">
                </form>
            </div>
        </div>

        <p class="border_ymn" style="margin: 0px;"></p>
        <br>

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
        <!--↓↓↓メニューバー-->
        <div id="wrapper_ymn">

            <div class="menu_ymn">
                <p class="border_ymn" style="margin: 0px;"></p>
                <div class="row footer_ymn" style="padding-left:35px;">
                    <div class="col-2" style="padding:0px;text-align: center;">
                        <form action="03_ホーム.php" method="post">
                            <button name="homelogo" type="hidden" value="1" style="text-decoration: none; background-color: transparent; border: none; outline: none; box-shadow: none;">
                                <img src="img/やますたぐるめ_ホームロゴ.png" width="78">
                            </button>
                        </form>
                    </div>
                    <div class="col-2" style="padding:0px;text-align: center;">
                        <form action="09_検索.php" method="post">
                            <button name="homelogo" type="hidden" value="1" style="text-decoration: none; background-color: transparent; border: none; outline: none; box-shadow: none;">
                                <img src="img/やますたぐるめ_検索ロゴ.png" width="78">
                            </button>
                        </form>
                    </div>
                    <div class="col-2" style="padding:0px;text-align: center;">
                        <form action="05_新規投稿作成.php" method="post">
                            <button name="homelogo" type="hidden" value="1" style="text-decoration: none; background-color: transparent; border: none; outline: none; box-shadow: none;">
                                <img src="img/やますたぐるめ_新規投稿ロゴ.png" width="78">
                            </button>
                        </form>
                    </div>
                    <div class="col-2" style="padding:0px;text-align: center;">
                        <form action="11_メッセージ一覧.php" method="post">
                            <button name="homelogo" type="hidden" value="1" style="text-decoration: none; background-color: transparent; border: none; outline: none; box-shadow: none;">
                                <img src="img/やますたぐるめ_.DMロゴ.png" width="78">
                            </button>
                        </form>
                    </div>
                    <div class="col-2" style="padding:0px;text-align: center;">
                        <form action="06_プロフィール.php" method="post">
                            <button name="homelogo" type="hidden" value="1" style="text-decoration: none; background-color: transparent; border: none; outline: none; box-shadow: none;">
                                <img src="img/やますたぐるめ_プロフィールロゴ.png" width="78">
                            </button>
                        </form>
                    </div>
                    <div class="col-1" style="padding:0px"></div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
            <!--自作のJS-->
            <script src="js/slide_show.js"></script>
    </body>
</php>