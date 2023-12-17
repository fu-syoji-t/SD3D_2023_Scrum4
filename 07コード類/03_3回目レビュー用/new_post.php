<?php

session_start();

require 'DBManager_ys.php';
$dbmng = new DBManager();

$number = 0;
$post_id = 0;
$number_array = 0;
$photo_number=0;

foreach($_FILES['photo_file']['name'] as $row){
        $number += 1; //データの数を取得
}

$date = date('Y-m-d H:i:s'); //投稿の日時を取得

//画像、動画以外の情報保存

$ps = array();
$ps = $dbmng->post_new($_SESSION['user']['id'],$_POST['posttext'],$date,$_POST['postregion']);

foreach($ps as $row){
 $post_id = $row['max(post_id)'];
}

//とりあえず画像は一枚のみにする
//画像を取り出してtmpフォルダーに移動させる
foreach($_FILES['photo_file']['name'] as $row){
    $photo_number += 1;
    $file_name = $post_id.'_'.$photo_number; //ファイルの名前　投稿ID_何番目かの画像

    $file_up = 'tmp/'.$file_name;
    move_uploaded_file($_FILES['photo_file']['tmp_name'][$number_array],$file_up.'.png');


    //画像を圧縮する
    //圧縮するファイルのパス
    $sourceFilePath = 'tmp/'.$file_name.'.png';
    $zipFilePath = 'tmp/'.$file_name.'.zip';

    $zip = new ZipArchive();

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
            $zip->addFile($sourceFilePath, $file_name.'.png');
            $zip->close();
        } else {
            //エラーをそのうち書きます
        }


    //圧縮化した画像ファイルをdbに保存
    $zip_folder_data = file_get_contents($zipFilePath); //ファイルの中身を文字列化する
    $ps = $dbmng->post_zip($post_id,$zip_folder_data,$photo_number);

    //ファイルを削除
    if (unlink($zipFilePath)&&unlink($sourceFilePath)){
        
    }else{
        
    }

    $number_array += 1;
}

//タグを登録
$date = $_POST['posttag'];
$taguArray = explode("#", $date);

foreach($taguArray as $row_tagu){
    
    $ps = $dbmng->hashtag_INSERT($row_tagu,$post_id);
}

header('Location:03_ホーム.php');
?>