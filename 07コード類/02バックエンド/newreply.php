<?php

session_start();
$pdo = new PDO('mysql:host=localhost;dbname=yamasutagourmet;charset=utf8', 'root', 'root');

$datetime = date('Y-m-d H:i:s');

$sql = "SELECT * FROM reply WHERE date_time = (SELECT Max(date_time) FROM reply)";
$ps = $pdo->prepare($sql);
$ps->execute();
foreach($ps as $row){
    $idnum = $row['reply_id'];
    $idnum = substr($idnum,2);
    $idnum = (int)$idnum;
    $idnum = $idnum + 1;
    $replyid = "00{$idnum}";
}

$sql="INSERT INTO reply(reply_id, reply_subject, user_id, reply_contents, date_time) VALUES(?,?,?,?,?)";
$ps=$pdo->prepare($sql);
$ps->bindValue(1,$replyid,PDO::PARAM_STR);
$ps->bindValue(2,$_POST['newreply'],PDO::PARAM_STR);
$ps->bindValue(3,$_SESSION['user']['id'],PDO::PARAM_STR);
$ps->bindValue(4,$_POST['replycontents'],PDO::PARAM_STR);
$ps->bindValue(5,$datetime,PDO::PARAM_STR);
$ps->execute();


// コメント数を更新
$a = substr($_POST['newreply'],0,2);
if($a != "00"){

    $sql = "SELECT comments FROM post WHERE post_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$_POST['newreply'],PDO::PARAM_STR);
    $ps->execute();
    foreach($ps as $row){
        $newcomments = $row['comments'] + 1;
    }

    $sql = "UPDATE post SET comments = ? WHERE post_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$newcomments,PDO::PARAM_INT);
    $ps->bindValue(2,$_POST['newreply'],PDO::PARAM_STR);
    $ps->execute();

}else{
    $sql = "SELECT comments FROM reply WHERE reply_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$_POST['newreply'],PDO::PARAM_STR);
    $ps->execute();
    foreach($ps as $row){
        $newcomments = $row['comments'] + 1;
    }

    $sql = "UPDATE reply SET comments = ? WHERE reply_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$newcomments,PDO::PARAM_INT);
    $ps->bindValue(2,$_POST['newreply'],PDO::PARAM_STR);
    $ps->execute();
}

header('Location:04_投稿詳細.php');

?>