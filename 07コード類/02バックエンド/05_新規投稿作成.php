<!DOCTYPE html>
<html>
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
</head>
<style>
</style>

<body>
    <h1>
        <div class="message_nh">
            <div class="container-fluid">
             新規投稿
            </div>
            <hr class="newpost-meinline_nh">
        </div>
    </h1>

    <form action="new_post.php" method="post" enctype="multipart/form-data">
    <!--<form action="check_imagick.php" method="post" enctype="multipart/form-data">-->
    <div class="row">
        <div class="col-4">
            <label class="upload-label_nh" id="upload-photo_nh">
            <input type="file" name="photo_file[]" id="input_file" multiple src="img/photoadd.png">
            </div>
            <div Class="col-8">
            <img id="image_nh"></label>
            <!-- 画像を表示する領域 -->
            <div id="image_preview">
            </div>
            <!-- 選択された画像がここに表示されます -->
         </div>
    </div>

  <script>
    const input_file = document.getElementById("input_file");
    const image_preview = document.getElementById("image_preview");

    input_file.addEventListener("change", function (e) {
      // 選択されたファイルのリストを取得
      const files = e.target.files;

      // 選択されたすべての画像を表示
      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function () {
          // 画像を表示するための新しいimg要素を作成
          const img = document.createElement("img");
          img.src = reader.result;
          img.style.maxWidth = "100px"; // 画像の最大幅を設定

          // 画像を表示領域に追加
          image_preview.appendChild(img);
        };

        // ファイルを読み込む
        reader.readAsDataURL(file);
      }
    });
  </script>


    <hr class="subline_nh">
    <!--本文-->
    <textarea name="posttext" class="newpost_text_nh" rows="6" maxlength="300" required placeholder="本文"></textarea>
    <hr class="subline_nh">
    <!--タグ-->
    <textarea name="posttag" class="newpost_text_nh" rows="3" maxlength="100" required placeholder="タグ"></textarea>
    <hr class="subline_nh">
    <!--地域-->
    <textarea name="postregion" class="newpost_text_nh" rows="3" maxlength="100" required placeholder="地域"></textarea>
    <hr class="subline_nh">
    <br>
    <div class="row">
        <div class="col-6">
            <button type="button" class="cancelbtn_nh" onclick="location.href='03_ホーム.html'" style="background-color: #7dcfff;">キャンセル</button>
        </div>
        <div class="col-6">
             <input type="submit" class="postbtn_nh" value="投稿" style="background-color: #7dcfff;">
            </form>
        </div>
    </div>
</body>
</html>