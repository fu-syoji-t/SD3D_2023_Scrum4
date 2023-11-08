<?php

session_start();
$pdo = new PDO('mysql:host=localhost;dbname=yamasutagourmet;charset=utf8', 'root', 'root');

//フォローする➔フォローをやめる
if($_POST['followbtn'][0] == 2){
$sql = "DELETE FROM follow WHERE user_id = ? AND partner_id = ?";
$ps = $pdo->prepare($sql);
$ps->bindValue(1,$_SESSION['user']['id'],PDO::PARAM_INT);
$ps->bindValue(2,$_POST['partner']/* 対象ユーザID */,PDO::PARAM_INT);
$ps->execute();

header('Location:13_FF一覧.php?follownum='.$_POST['followbtn'][1]);

}

//フォローをやめる➔フォローする
if($_POST['followbtn'][0] == 1){
$sql="INSERT INTO follow(user_id, partner_id) VALUES(?,?)";
$ps=$pdo->prepare($sql);
$ps->bindValue(1,$_SESSION['user']['id'],PDO::PARAM_STR);
$ps->bindValue(2,$_POST['partner']/* 対象ユーザID */,PDO::PARAM_STR);
$ps->execute();
}

header('Location:13_FF一覧.php?follownum='.$_POST['followbtn'][1]);

?>