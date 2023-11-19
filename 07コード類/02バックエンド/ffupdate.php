<?php

session_start();

require 'DBManager_ys.php';
$dbmng = new DBManager();

//受け取った値をそれぞれの変数に入れる
$date = $_POST['followbtn'];
$ffArray = explode(",", $date);

$check = $ffArray[0]; //13か14なのか
$partner_id = $ffArray[1]; //相手のuser_id

//フォロワーの時に使う　1フォローする　2フォローをやめる
if(isset($ffArray[2])){
$ff_wakeru = $ffArray[2];
}

//フォローから来た時
if($check == 13){
    //削除するsql
    $ps = $dbmng->ff_delete($_SESSION['user']['id'],$partner_id);
    header('Location:13_フォロー一覧.php');
//フォロワーから来た時
}else if($check == 14){

    //フォローするのかやめるのかを判別 フォローする場合
    if($ff_wakeru == 1){

        //フォローするsql
        $ps = $dbmng->ff_insert($_SESSION['user']['id'],$partner_id);

    }else if($ff_wakeru == 2){
        
        //フォローをやめる
        $ps = $dbmng->ff_delete($_SESSION['user']['id'],$partner_id);
    }
    header('Location:14_フォロワー一覧.php');
}


?>