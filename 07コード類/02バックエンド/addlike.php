<?php
session_start();
require 'DBManager_ys.php';
$dbmng = new DBManager();

$date = $_POST['like'];
$likeArray = explode(",", $date);

$like = $likeArray[0]; //13か14なのか
$post_id = $likeArray[1]; //相手のuser_id

$notlike = "notlike";
if(!strcmp($like,$notlike)){ //いいね登録
    $ps = $dbmng->like_insert($_SESSION['user']['id'],$post_id);
}else{
    $ps = $dbmng->like_delete($_SESSION['user']['id'],$post_id);
}

header('Location:04_投稿詳細.php');
?>