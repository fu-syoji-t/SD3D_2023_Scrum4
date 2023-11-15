<?php

session_start();

require 'DBManager_ys.php';
$dbmng = new DBManager();

//フォローから来た時
if($_POST['followbtn'][0] = 13){

    //削除するsql
    $ps = $dbmng->ff_delete($_SESSION['user']['id'],$_POST['followbtn'][1]);

//フォロワーから来た時
}else if($_POST['followbtn'][0] = 14){

}


?>