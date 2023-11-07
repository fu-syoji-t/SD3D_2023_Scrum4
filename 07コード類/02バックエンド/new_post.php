<?php

session_start();

require 'DBManager_ys.php';
$dbmng = new DBManager();

$number = 0;
$post_id = 0;

/*foreach($_FILES['photo_file']['name'] as $row){
        $number += 1;
}*/

foreach($_FILES['photo_file']['name'] as $row){
        $number += 1; //データの数を取得
}
echo $number;

$date = date('Y-m-d H:i:s'); //投稿の日時を取得

//画像、動画以外の情報保存

$ps = array();
$ps = $dbmng->post_new($_SESSION['user']['id'],$_POST['posttext'],$date,$_POST['postregion']);



/*if($_FILES['photo_file']['size'] >= 10485760){  //ファイルの大きさで弾くコード
        $_SESSION['error'] = "ファイルのサイズがオーバーしています。アップできる容量は10Mまでです。";
        header('Location:05_新規投稿作成.php'); 
}*/

foreach($ps as $row){
 $post_id = $row['max(post_id)'];
}

$file = $_FILES['photo_file'];

$file_name = $file['name'];
$temp_file = $file['tmp_name'];

    // 一時ディレクトリにファイルを保存
    $temp_path = 'temp/' . $file_name; // 一時ディレクトリを作成して指定
    move_uploaded_file($temp_file, $temp_path);

//zip
$zip = new ZipArchive();
$zip_file = 'compressed.zip';

if ($zip->open($zip_file, ZipArchive::CREATE) === true) {
        $zip->addFile($temp_file, $file_name);
        $zip->close();

        // Zipファイルをデータベースに保存する処理
        // この部分はデータベースの種類に依存します
        $ps = $dbmng->post_zip($post_id,$zip_file);
        // ファイルを削除
        unlink($temp_file);
    } else {
        echo "ファイルの圧縮に失敗しました。";
    }





/*
$date=date('Y-m-d H:i:s');
$zero=0;

$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
if($_FILES['file']['size'] >= 10485760){ //10M以上だったらエラーを表示する
        $_SESSION['error'] = "ファイルのサイズがオーバーしています。アップできる容量は10Mまでです。";
        //header('Location:10_新規投稿作成画面.php');
}

//if (!empty($_FILES['file']['name'])) {//画像または動画がある場合
        $file = $_FILES['file'];

        $filename = $file['name'];
        $filetype = $file['type'];
        $filedata = file_get_contents($file['tmp_name']);

                if($extension == "MP4" || $extension == "mp4"){ //拡張子がmp4、MP4
                        //mp4
                       $pdo = new PDO('mysql:host=localhost;dbname=yamasutagourmet;charset=utf8','root','root');
                        $sql ="INSERT into post(user_id,post_contents,date_time,regiion,media1,media2,media3,media4)
                                value(?,?,?,?,?,?,?,?)";
                        $ps = $pdo->prepare($sql);
                        $ps->bindValue(1,$_SESSION['user']['id'],PDO::PARAM_STR);//ユーザーID
                        $ps->bindValue(2,$_POST['posttext'],PDO::PARAM_STR);//投稿内容
                        $ps->bindValue(3,$date,PDO::PARAM_STR);//日時
                        $ps->bindValue(4,$_POST['postlocal'],PDO::PARAM_LOB);//地域名
                        $ps->bindValue(5,$filedata,PDO::PARAM_STR);//メディア
                        $ps->bindValue(6,"2",PDO::PARAM_STR);//動画は2
                        $ps->bindValue(7,"2",PDO::PARAM_STR);//動画は2
                        $ps->bindValue(8,"2",PDO::PARAM_STR);//動画は2
                        $ps->execute();

                        if(!empty($_POST['posttag'])){
                            $sql = "SELECT post_id FROM post WHERE post_id=(SELECT max(post_id) FROM post)";
                            $ps = $pdo->prepare($sql);
                            $ps->execute();
                            foreach($ps as $row){
                                $postid = $row['post_id'];
                            }
    
                            $sql = "INSERT into hashtag(hashtag_name,post_id) VALUE(?,?)";
                            $ps = $pdo->prepare($sql);
                            $ps->bindValue(1,$_POST["posttag"],PDO::PARAM_STR);
                            $ps->bindValue(2,$postid,PDO::PARAM_INT);
                            $ps->execute();
                        }
    
                }else{
                        //画像
                        $pdo = new PDO('mysql:host=localhost;dbname=yamatter;charset=utf8','root','root');
                        $sql ="INSERT into post(user_id,post_contents,date_time,regiion,media1,media2,media3,media4)
                        value(?,?,?,?,?,?,?,?)";
                        $ps = $pdo->prepare($sql);
                        $ps->bindValue(1,$_SESSION['user']['id'],PDO::PARAM_STR);//ユーザーID
                        $ps->bindValue(2,$_POST['posttext'],PDO::PARAM_STR);//投稿内容
                        $ps->bindValue(3,$date,PDO::PARAM_STR);//日時
                        $ps->bindValue(4,$_POST['postlocal'],PDO::PARAM_LOB);//地域名
                        $ps->bindValue(5,$filedata,PDO::PARAM_STR);//メディア
                        $ps->bindValue(6,"1",PDO::PARAM_STR);//画像は1
                        $ps->bindValue(7,"1",PDO::PARAM_STR);//画像は1
                        $ps->bindValue(8,"1",PDO::PARAM_STR);//画像は1
                        $ps->execute();

                        if(!empty($_POST['posttag'])){
                            $sql = "SELECT post_id FROM post WHERE post_id=(SELECT max(post_id) FROM post)";
                            $ps = $pdo->prepare($sql);
                            $ps->execute();
                 
                            foreach($ps as $row){
                                $postid = $row['post_id'];
                        }
    
                            $sql = "INSERT into hashtag(hashtag_name,post_id) VALUE(?,?)";
                            $ps = $pdo->prepare($sql);
                            $ps->bindValue(1,$_POST["posttag"],PDO::PARAM_STR);
                            $ps->bindValue(2,$postid,PDO::PARAM_INT);
                            $ps->execute();
                        }
                }
        
        /*}else{ //何もないばあい
                $pdo = new PDO('mysql:host=localhost;dbname=yamatter;charset=utf8','root','root');
                $sql ="INSERT into post(user_id,genre_id,post_contents,date_time,fabulous,comments)
                        value(?,?,?,?,?,?)";
                $ps = $pdo->prepare($sql);
                $ps->bindValue(1,$_SESSION['user']['id'],PDO::PARAM_STR);//ユーザーID
                $ps->bindValue(2,$_POST['genre'],PDO::PARAM_STR);//ジャンル
                $ps->bindValue(3,$_POST['text'],PDO::PARAM_STR);//投稿内容
                $ps->bindValue(4,$date,PDO::PARAM_STR);//日時
                $ps->bindValue(5,$zero,PDO::PARAM_STR);//いいね数
                $ps->bindValue(6,$zero,PDO::PARAM_STR);//コメント数
                $ps->execute();
}*/

//header('Location:07_ジャンル別投稿一覧画面.php');//modorimasu


?>