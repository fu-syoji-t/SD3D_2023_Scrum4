<?php

session_start();
$pdo = new PDO('mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1417495-yamasuta;charset=utf8', 'LAA1417495', 'sotA1140');

$sql = "SELECT *, count(*) FROM keep WHERE post_id = ?";
$ps = $pdo->prepare($sql);
$ps->bindValue(1, $_POST['saveid'], PDO::PARAM_STR);
$ps->execute();
foreach ($ps as $row) {

    $sql2 = "SELECT *, count(*) FROM post WHERE post_id = ?";
    $ps2 = $pdo->prepare($sql2);
    $ps2->bindValue(1, $_POST['saveid'], PDO::PARAM_STR);
    $ps2->execute();
    foreach ($ps2 as $row2) {
        $postuser = $row2['user_id'];
    }

    if ($row['count(*)'] == 0) {

        $sql = "INSERT INTO keep(post_id, user_id) VALUES(?,?)";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $_POST['saveid'], PDO::PARAM_STR);
        $ps->bindValue(2, $_SESSION['user']['id'], PDO::PARAM_STR);
        $ps->execute();
    } else {

        $sql = "DELETE from keep WHERE post_id = ?";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $_POST['saveid'], PDO::PARAM_STR);
        $ps->execute();
    }

    header('Location:04_detail_post.php');
}
