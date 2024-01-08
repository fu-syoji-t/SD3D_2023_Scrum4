<?php 
session_start(); 
require 'DBManager_ys.php';
    $dbmng = new DBManager();
?>
<!DOCTYPE html>
<html>

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>やますたぐらむ | チャット一覧</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.4/css/all.css">
    <link href="css/nakai.css" rel="stylesheet" type="text/css">
    <link href="css/yamane.css" rel="stylesheet" type="text/css">
    <link href="css/yamanishi.css" rel="stylesheet" type="text/css">
    <link href="css/tomoyuki.css" rel="stylesheet" type="text/css">
    <link href="css/detail/menu.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
</head>
<style>
</style>

<body class="body_ymn message-body_ymn">

<!--07が未完成だから仮入力　相手側のuser_idを取得-->
<?php 
if(isset($_POST['partner_name'])){
    $_SESSION['partner_name'] = $_POST['partner_name'];
} 

?>
    <header class="header_ymn">
        <button type="button" class="chatback_ymn" onclick="location.href='11_メッセージ一覧.php'" value="遷移">く</button>
        <h5 class="dm-titlename_ymn"><?php echo $_SESSION['partner_name']; ?></h5>
    </header>

    <!--↓山西-->
    <main>
<?php 
if(isset($_POST['partner'])){
    $_SESSION['partner_id'] = $_POST['partner'];
}

//dm_idを検索
$ps = $dbmng->dm_id_select($_SESSION['user']['id'],$_SESSION['partner_id']);

foreach($ps as $row){
    $dm_id = $row['dm_id'];
}

//ここからメッセージ表示
if(isset($dm_id)){
    $ps = $dbmng->message_select($dm_id);
        foreach($ps as $row){
            if($row['user_id'] == $_SESSION['partner_id']){
        echo   '<!--相手のメッセージ-->
                <div class="another_person_message_ys chat_ymn">
                    <p class="chatmessage_ymn">'.$row['message'].'</p>
                </div><br>';
            }else if($row['user_id'] == $_SESSION['user']['id']){
        echo '<!--自分のメッセージ-->
                <div style="text-align: right;">
                    <div class="my_message_ys mychat_ymn">
                        <p class="chatmessage_ymn">'.$row['message'].'</p>
                    </div>
                </div>';
    }
}
}

//既読機能
if(isset($dm_id)){
    $ps = $dbmng->dm_read($dm_id,$_SESSION['user']['id']);
}
?>
    </main>

    <div id="wrapper_ymn">

        <div class="menu_ymn">
            <p class="border_ymn" class="margin-bo10"></p>
            <div class="row footer_ymn padding-le35" class="">
                <div class="row">
                    <div class="col-9">
                    <form action="dm.php" method="post">
                        <textarea class="dmform_ymn" rows="1" maxlength="300" name="message"></textarea>
                        <?php 
                        if(isset($dm_id)){
                        echo '<input type="hidden" name="dm_id" value="'.$dm_id.'">';
                        }else{
                            echo '<input type="hidden" name="partner_id" value="'.$_SESSION['partner_id'].'">';
                        }
                        ?>
                    </div>
                    <div class="col-3">
                            <input type="submit" class="dmsend_ymn" value="送信" style="background-color: #7dcfff;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!--自作のJS-->
    <script src="js/slide_show.js"></script>
</body>

</html>