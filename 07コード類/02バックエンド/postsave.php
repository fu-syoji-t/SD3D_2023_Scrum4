<?php

session_start();
$pdo = new PDO('mysql:host=localhost;dbname=yamasutagourmet;charset=utf8', 'root', 'root');

$sql = "SELECT * FROM post WHERE post_id = ?";
$ps = $pdo->prepare($sql);
$ps->bindValue(1,$_POST['saveid'],PDO::PARAM_STR);
$ps->execute();
foreach($ps as $row){
    $postuser = $row['user_id'];
}

$sql="INSERT INTO keep(post_id, user_id) VALUES(?,?)";
$ps=$pdo->prepare($sql);
$ps->bindValue(1,$_POST['saveid'],PDO::PARAM_STR);
$ps->bindValue(2,$postuser,PDO::PARAM_STR);
$ps->execute();

header('Location:04_投稿詳細.php');

?>