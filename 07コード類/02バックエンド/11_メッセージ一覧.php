<?php session_start(); 
if(isset($_SESSION['partner_name']) && isset($_SESSION['partner_id'])){
  $_SESSION['partner_id'] = array();
  $_SESSION['partner_id'] = array();
}

?>
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
    <link href="../01フロントエンド/css/detail/menu.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
</head>
<style>
</style>

<body>
    <h1>
        <div class="message_nh">
            <div class="container-fluid">
             Message
            </div>
            <hr class="meinline_nh">
        </div>
    </h1>
    <div class="row">

    <?php 
    require 'DBManager_ys.php';
    $dbmng = new DBManager();
    $ps = $dbmng->dm_list_select($_SESSION['user']['id']);
     
  foreach($ps as $row){
    if($_SESSION['user']['id'] != $row['user_id1']){//ここでuserid1,2を比較　相手側のidを取得
      $partner_id = $row['user_id1'];
    }else{
      $partner_id = $row['user_id2'];
    }

    $partner_ps = $dbmng->user($partner_id);
    foreach($partner_ps as $row2){
      $partner_name = $row2['user_name'];
     }
     
echo     '<ul>
          <li>
            <form action="12_チャット一覧.php" method="post">
                <div class="col-2" id="icon_circle_nh"></div>
                  <div class="col-10" id="message-name_nh">
                    <div class="list-link">
                      <button type="hidden" class="chat_nh" value="'.$partner_id.'" name="partner">
                        <a><span class="material-symbols-outlined chat-name_nh">'.$partner_name.'</span></a>
                      </button>
                      
                      <input type="hidden" name="partner_name" value="'.$partner_name.'">';
                      
                      if($row['dm_read'] != $_SESSION['user']['id'] && $row['dm_read'] != 0){
                        echo  '<div class="col-2" id="notice_circle_nh"></div>';
                      }
                    echo'</div>
                  </div>
               <hr class="subline_nh">
               
              </form>
          </li>
        </ul>';
  }
  
    ?>
    </div>
          <!--↓↓↓メニューバー-->
          <div class="menu">
      <div class="home_menu">
      <button class="menu_botton">
          <img src="img/やますたぐるめ_ホームロゴ.png"  onclick="location.href='03_ホーム.php'" width="78">
      </button>
      </div>

      <div class="search_menu">
      <button class="menu_botton">
          <img src="img/やますたぐるめ_検索ロゴ.png" onclick="location.href='09_検索.php'" width="78">
      </button>
      </div>

      <div class="newpost_menu">
      <button class="menu_botton">
          <img src="img/やますたぐるめ_新規投稿ロゴ.png" onclick="location.href='05_新規投稿作成.php'" width="78">
      </button>
      </div>

      <div class="dm_menu">
      <button class="menu_botton">
          <img src="img/やますたぐるめ_.DMロゴ.png" onclick="location.href='11_メッセージ一覧.php'" width="78">
      </button>
      </div>

      <div class="profile_menu">
      <button class="menu_botton">
          <img src="img/やますたぐるめ_プロフィールロゴ.png" onclick="location.href='06_プロフィール.php'" width="78">
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