<?php

session_start();

require 'DBManager_ys.php';
$dbmng = new DBManager();

$number = 0;
$post_id = 0;
$number_array = 0;

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

//↓↓↓ファイルをtmpフォルダに一時的に保存する

//画像の枚数だけ繰り返して一枚一枚保存するforeach
foreach($_FILES['photo_file']['name'] as $row){
        //フォルダー名を作成
        $tmp_foname = $_SESSION['user']['id'].'file'.$post_id;
        //存在しなかったら新しくフォルダーを作る
        if(!file_exists('tmp/'.$tmp_foname)){
                $pas_tmp = 'tmp/'.$tmp_foname.'';
                mkdir($pas_tmp, 0777, true );
        }
        $file_up = 'tmp/'.$tmp_foname.'/'.basename($_FILES['photo_file']['name'][$number_array]);
        move_uploaded_file($_FILES['photo_file']['tmp_name'][$number_array],$file_up);
        $number_array += 1;
}

//↑↑↑ファイルをtmpフォルダに一時的に保存する



//↓↓↓圧縮の処理をする

//圧縮するフォルダーのパス →$pas_tmp
$folderToCompress = $pas_tmp;

//圧縮後のフォルダーの名前を設定する
$tmp_foname_zip = $_SESSION['user']['id'].'file'.$post_id.'.zip';
//圧縮後のパスとフォルダーの名前
$zipFilePath = 'tmp/'.$tmp_foname_zip;


// ZipArchiveクラスのインスタンスを作成
$zip = new ZipArchive();

// 新しいZIPアーカイブファイルを作成または既存のZIPファイルを開く
if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
    // フォルダ内のファイルを再帰的に取得し、ZIPに追加
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folderToCompress));
    foreach ($files as $file) {
        if (!$file->isDir()) {
            $fileToAdd = $file->getPathname();
            $relativePath = substr($fileToAdd, strlen($folderToCompress) + 1);
            $zip->addFile($fileToAdd, $relativePath);
        }
    }

    // ZIPアーカイブをクローズし、ZIPファイルを保存
    $zip->close();
    echo 'ZIPアーカイブが正常に作成されました。';
} else {
    echo 'ZIPアーカイブを開けませんでした。';
}

//↑↑↑圧縮の処理をする


//zipファイルをDBに保存
$zip_folder_data = file_get_contents($zipFilePath);
$ps = $dbmng->post_zip($post_id,$zip_folder_data);


//tmpフォルダーからzipファイルとフォルダーを削除
//move_uploaded_file($tmp_foname_zip,'trash/'.$tmp_foname_zip);
if(rename('tmp/'.$tmp_foname_zip,'trash/'.$tmp_foname_zip)&&rename($pas_tmp,'trash/'.$tmp_foname)){
        array_map('unlink', glob('trash/*.*'));
        array_map('unlink', glob('trash/'.$tmp_foname.'/*.*'));
        rmdir('trash/'.$tmp_foname);
}

header('Location:07_ジャンル別投稿一覧画面.php');//modorimasu

?>