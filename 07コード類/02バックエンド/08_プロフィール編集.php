<!DOCTYPE html>
<html>

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>やますたぐらむ | プロフィール編集</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.4/css/all.css">
    <link href="../css/nakai.css" rel="stylesheet" type="text/css">
    <link href="../css/yamane.css" rel="stylesheet" type="text/css">
    <link href="../css/yamanishi.css" rel="stylesheet" type="text/css">
    <link href="../css/tomoyuki.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
</head>
<style>
    input[type="file"] {
      display: none;
    }
</style>

<body>

    <form action="profile_update.php" method="post" enctype="multipart/form-data">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 back_pink_yamani" style="height:100vh"></div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-5"></div>
                                <div class="col-md-1">
                                    <!--<img class="image_middle" src="img/pink.png" style="margin-top:25px; ">-->
                                    <?php
                                        if (!empty($_SESSION['user']['icon']) || isset($_SESSION['user']['icon'])) { //設定している場合
      
                                            $base64_image = base64_encode($_SESSION['user']['icon']);
      
                                            echo '<br>' . '<img class="image_middle" width="250"src="data:image/jpeg;base64,' .  $base64_image . '" />　';
      
                                        } else { //設定してない場合
      
                                            echo '<img class="image_middle" src="img/pink.png">　';
                                        }
                                    ?>

                                    <label class="btn container-fluid color_white_yamani aikn_ys start_0_ys border border-dark">
                                        <input type="file" name="file" accept="image/*">
                                        <p class="p_pusu_ys">＋</p>
                                    </label>

                                </div>
                                <div class="col-md-6 usiro_ys">
                                <!--<p style="margin-left:30px;margin-top: 45px;"><?php //echo $_SESSION['user']['name'] 
                                                                    ?></p>-->
                            </div>
                        </div><br>
                        <p style="margin-left: 30px;">名前</p>
                        <input type="text" class="form-control" name="username" required value="<?php echo $_SESSION['user']['name']; ?>" style="width:570px; margin: 0 auto; border-color:#FBA8B8;border-width:3px;">
    
                        <textarea class="sayu_ys form-control alert-light magin40_yamanisi " 
                            style="width: 90%;height: 30px;text-align:left;border:none;overflow-wrap: break-word;margin-top: 70px;" 
                            name="introduction" id="txt1" maxlength="200" placeholder="自己紹介"><?php echo $_SESSION['user']['introduction']; ?></textarea>
                        <hr class="sayu_ys">
                        <div style="text-align: right;margin-right: 30px;">
                        <p>200文字</p>
                    </div>
                    <hr class="line" id="hr_nh">
                    <div class="text-line " style="margin-bottom: 20px;">
                    <p>好きなジャンル</p>
                </div>
            </div>
            <div class="row magin40_yamanisi">
                <div class="col-md-6" id="btn_nh">
                <!--<div class="col-md-3" id="btn_nh">-->
                    <button onclick="location.href='05_プロフィール画面.php'" class="btn container-fluid color_white_yamani" style="background-color:#FBA8B8;width: 90%;margin-left: 30px;">キャンセル</button>
                </div>
                <div class="col-md-6" id="btn_nh">
                    <button value="保存" name="update" type="submit" class="btn container-fluid color_white_yamani" style="background-color:#FBA8B8;width: 90%;margin-right: 30px;">保存</button>
                </div>
            </div>
        </div>
        <div class="col-md-3" style="background-color:#FBA8B8;"></div>
        </div>
      </div>
    </form>

</body>
</html>