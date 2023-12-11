<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>やますたぐるめ | 投稿詳細</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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

<body class="html_ymn">
    <div style="margin-bottom: 5px;">
        <div class="row">
            <div class="col-6">
                <!--<button type="button"  class="back_nh"  onclick="location.href='03_ホーム.html'" value="遷移">←</button>-->
                <a href="03_ホーム.php" class="back_nh">←</a>
            </div>
        </div>
        <?php

        $pdo = new PDO('mysql:host=localhost;dbname=yamasutagourmet;charset=utf8', 'root', 'root');

        $id = "4";
        // 投稿テーブルの詳細を取得
        $sql = "SELECT * FROM post INNER JOIN user ON post.user_id = user.user_id 
                WHERE post_id = ?";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $id/* 前ページで受取ったpost_id */, PDO::PARAM_INT);
        $ps->execute();
        $searchArray = $ps->fetchAll();

        foreach ($searchArray as $row) { // 投稿詳細の情報を変数に格納
            $postid = $row['post_id'];
            $postcontents = $row['post_contents'];
            $datetime = $row['date_time'];
            $fabulousnum = $row['fabulous'];
            $comentsnum = $row['comments'];
            $region = $row['region'];
            $media1 = $row['media1'];
            $media2 = $row['media2'];
            $media3 = $row['media3'];
            $media4 = $row['media4'];
            $postuserid = $row['user_id'];
            $usericon = $row['icon'];
            $username = $row['user_name'];
        }

        ?>
        <br>
        <div class="row">
            <div class="col-3" id="post-icon_circle_nh"></div>
            <div class="col-9"><?php echo $username; ?></div>
        </div>
        <div class="postphoto-big_nh"></div>
        <br>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-2">
                <?php
                if (isset($check_like)) { //いいね判別
                    echo '<form action="addlike.php" method="post">';
                    $like = "like" . $postid;
                    echo '<button type="hidden" name="like" value="1,' . $postid . ',8" style="width:90px;background-color:white;border:none;">
                              <input type="checkbox" checked="checked" id="' . $like . '">
                              <label for="' . $like . '">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                              <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                              </svg>　' . $fabulousnum . '　　　';
                    echo '</label>
                              </button>
                              </form>';
                } else {
                    echo '<form action="addlike.php" method="post">';
                    $like = "like" . $postid;
                    echo '<button type="hidden" name="like" value="2,' . $postid . ',8" style="width:90px;background-color:white;border:none;">
                              <input type="checkbox" id="' . $like . '">
                              <label for="' . $like . '">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                              <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                              </svg>　' . $fabulousnum . '　　　';
                    echo '</label>
                              </button>
                              </form>';
                }
                echo '</div>
                          <div class="col-2">
                          <div id="good_nh">
                          <img src="img/やますたぐるめ_コメント正方形.png" height="38" style="margin-top: -15px; margin-left: -15px;">
                          </div>
                          <div style="position: relative; top:-34px;left:90px;">
                           　' . $comentsnum .
                    '</div>
                    </div>';
                ?>

                <!--保存した後の遷移をどうするか聞く-->
                <div class="col-4"></div>
                <div class="col-3">
                    <?php

                    $postid = 4;

                    echo '<form action="postsave.php" method="post">
                    <button type="hidden" name="saveid" value="'.$postid.'" id="openModalBtn" class="savebtn_nh">保存</button>
                    </form>';

                    ?>
                </div>
            </div>

            <!-- モーダルウィンドウ -->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeModalBtn">&times;</span>
                    <h5 class="modal_nh" style="text-align: center" ;>投稿を保存しました</h5>
                </div>
            </div>

            <script>

                // 開くボタンをクリックしたときの処理
                document.getElementById("openModalBtn").addEventListener("click", function() {
                    var modal = document.getElementById("myModal");
                    modal.style.display = "block";

                    setTimeout(function() {
                        modal.style.display = "none";
                    }, 1500); // 1.5秒間表示してから閉じる
                });
                // 閉じるボタンをクリックしたときの処理
                document.getElementById("closeModalBtn").addEventListener("click", function() {
                    var modal = document.getElementById("myModal");
                    modal.style.display = "none";
                });

            </script>
        </div>

        <div class="posttext_nh"><?php echo $postcontents; ?></div><br>

        <?php

        $sql = "SELECT * FROM user INNER JOIN reply ON user.user_id = reply.user_id 
                WHERE reply_subject = ?";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $id, PDO::PARAM_STR);
        $ps->execute();
        $searchArray = $ps->fetchAll();

        foreach ($searchArray as $row) {
            echo '<div class="row">
            <div class="col-2" id="icon_circle-min_nh"></div>
            <div class="col-8" id="coment-name_nh">'.$row['user_name'].'</div>
            <div class="post-coment_nh">'.$row['reply_contents'].'</div>
            <form action="replyreply.php" method="post">
            <button type="hidden" name="replyreply" value="'.$row['reply_id'].'" class="replybtn_ymn">返信する</button>
            </form>';


            $sql2 = "SELECT * FROM reply INNER JOIN user ON reply.user_id = user.user_id 
                     WHERE reply_subject = ?";
            $ps2 = $pdo->prepare($sql2);
            $ps2->bindValue(1, $row['reply_id'], PDO::PARAM_STR);
            $ps2->execute();
            foreach ($ps2 as $row2) {
                $sql3 = "SELECT * FROM reply INNER JOIN user ON reply.user_id = user.user_id 
                         WHERE reply_id = ?";
                $ps3 = $pdo->prepare($sql3);
                $ps3->bindValue(1, $row2['reply_subject'], PDO::PARAM_STR);
                $ps3->execute();
                foreach ($ps3 as $row3) {
                    echo '<div class="col-1"></div>
                    <div class="col-2" id="icon_circle-min_nh"></div>
                    <div class="col-7" id="coment-name_nh">'.$row2['user_name'].'</div>
                    <div class="replyuser_ymn">@'.$row3['user_name'].'</div>
                    <div class="post-coment_nh">'.$row2['reply_contents'].'</div>
                    <form action="replyreply.php" method="post">
                    <button type="hidden" name="replyreply" value="'.$row2['reply_id'].'" class="replybtn_ymn">返信する</button>
                    </form>'; 

                    /*
                    $sql5 = "SELECT * FROM reply INNER JOIN user ON reply.user_id = user.user_id 
                             WHERE reply_subject = ?";
                    $ps5 = $pdo->prepare($sql5);
                    $ps5->bindValue(1, $row3['reply_id'], PDO::PARAM_STR);
                    $ps5->execute();
                    foreach ($ps5 as $row5) {
                        $sql6 = "SELECT * FROM reply INNER JOIN user ON reply.user_id = user.user_id 
                                 WHERE reply_id = ?";
                        $ps6 = $pdo->prepare($sql6);
                        $ps6->bindValue(1, $row5['reply_subject'], PDO::PARAM_STR);
                        $ps6->execute();
                        foreach ($ps6 as $row6) {
                            echo '<div class="col-1"></div>
                            <div class="col-2" id="icon_circle-min_nh"></div>
                            <div class="col-7" id="coment-name_nh">'.$row5['user_name'].'</div>
                            <div class="replyuser_ymn">@'.$row6['user_name'].'</div>
                            <div class="post-coment_nh">'.$row5['reply_contents'].'</div>
                            <form action="replyreply.php" method="post">
                            <button type="hidden" name="replyreply" value="'.$row5['reply_id'].'" class="replybtn_ymn">返信する</button>
                            </form>'; 
                        }
                    }
                    */
                }
            }
        }

        ?>

        <div id="wrapper_ymn">
            <div class="menu_ymn">
                <p class="border_ymn" style="margin-bottom: 10px;"></p>
                <div class="row footer_ymn" style="padding-left:35px;">
                    <div class="row">
                        <div class="col-9">
                            <?php

                            echo '<form action="newreply.php" method="post">';

                            if(isset($_SESSION['replyform'])){ 
                                
                                $sql4 = "SELECT * FROM reply INNER JOIN user ON reply.user_id = user.user_id 
                                         WHERE reply_id = ?";
                                $ps4 = $pdo->prepare($sql4);
                                $ps4->bindValue(1, $_SESSION['replyform'], PDO::PARAM_INT);
                                $ps4->execute();
                                    foreach ($ps4 as $row4) {
                                        echo '<textarea class="dmform_ymn" rows="1" maxlength="300" name="replycontents" placeholder="@' .$row4['user_name']. '"></textarea>';
                                }
                            }else{
                                echo '<textarea class="dmform_ymn" rows="1" maxlength="300" name="replycontents"></textarea>';
                            }

                            echo '</div>
                            <div class="col-3">
                            <button type="hidden" name="newreply" class="dmsend_ymn" value="';
                            
                            if(isset($_SESSION['replyform'])){
                                echo $_SESSION['replyform'];
                            }else{
                                echo $id;
                            }

                            echo '" style="background-color: #7dcfff;">送信</button>
                            </form>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

</body>

</html>