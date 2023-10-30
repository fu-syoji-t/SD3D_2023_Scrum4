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

<body class="profileupdate_ymn">
    <form action="profile_update.php" method="post" enctype="multipart/form-data">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5"></div>
                        <div class="col-md-1">
                            <div style="text-align:center"><img class="iconimage_ymn" src="img/やますたぐるめcolor.png"
                                    style="margin-top:25px; "></div>
                            <div style="margin-left: 200px; margin-top: -20px;">
                                <label class="btn container-fluid icon_ymn border border-dark">
                                    <input type="file" name="file" accept="image/*">
                                    <p class="iconmedia_ymn">＋</p>
                                </label>
                            </div>

                        </div>
                        <div class="col-md-6 usiro_ys">
                        </div>
                    </div><br>
                    <input type="text" class="form-control nameupdate_ymn" name="username" required value=""
                        placeholder="名前">

                    <textarea class="sayu_ymn form-control alert-light" name="introduction" id="txt1" maxlength="200"
                        placeholder="自己紹介"></textarea><br><br>
                </div>
                <div class="row">
                    <div class="col-6" id="btn_nh">
                        <button class="profileup_ymn" onclick="location.href='03_ホーム.html'"
                            class="btn container-fluid color_white_yamani">キャンセル</button>
                    </div>
                    <div class="col-6" id="btn_nh">
                        <button class="noprofileup_ymn" value="保存" name="update" type="submit"
                            class="btn container-fluid color_white_yamani">保存</button>
                    </div>
                </div>
            </div>
    </form>


</body>

</html>