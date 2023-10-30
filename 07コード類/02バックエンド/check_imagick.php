<?php
//Zip形式で圧縮するために必要なモジュールを一度だけ読み込む
require_once("Archive/Zip.php");

//Archive_Zipインスタンスを作成する
$zip = new Archive_Zip("test.zip");

//圧縮するファイルを指定する
//例では2つのファイル「text01.txt」「pict01.jpg」を指定
//ファイルはこのプログラムと同じフォルダ内に置く
$list = array("text01.txt","pict01.jpg");

//圧縮作業をおこなう
$zip->create($list);

//メッセージの表示
print("zip形式で圧縮しました。");
?>