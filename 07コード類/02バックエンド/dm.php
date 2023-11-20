<?php
session_start();

require 'DBManager_ys.php';
$dbmng = new DBManager();

//まだdmテーブルがない場合　初こめ
if(!isset($_POST['dm_id'])){

    //dmテーブルを製作後にdm_idを取得する
    $ps = $dbmng->dm_new_table($_SESSION['user']['id'],$_POST['dm_id'],$_POST['message']);
        foreach($ps as $row){
            $dm_id = $row['dm_id'];
        }
    //dm_idを取得後に投稿を登録する
    $ps = $dbmng->dm_new_insert($dm_id,$_SESSION['user']['id'],$_POST['message']);


}else if(isset($_POST['dm_id'])){//こっちはある場合　コメを登録

    $ps = $dbmng->dm_insert($_SESSION['user']['id'],$_POST['dm_id'],$_POST['message']);

}
header('Location:12_チャット一覧.php');
?>