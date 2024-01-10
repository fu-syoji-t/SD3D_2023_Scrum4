<?php

session_start();

$pdo = new PDO('mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1417495-yamasuta;charset=utf8', 'LAA1417495', 'sotA1140');

if (!empty($_FILES['file']['name'])) {
    $file = $_FILES['file'];

    $filename = $file['name'];
    $filetype = $file['type'];
    $filedata = file_get_contents($file['tmp_name']);

    $pdo = new PDO('mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1417495-yamasuta;charset=utf8', 'LAA1417495', 'sotA1140');
    $sql ="UPDATE user SET user_name=?, icon=?, self_introduction=? WHERE user_id=?";
    $ps=$pdo->prepare($sql);
    $ps->bindValue(1,$_POST['username'],PDO::PARAM_STR);
    $ps->bindValue(2,$filedata,PDO::PARAM_LOB);
    $ps->bindValue(3,$_POST['introduction'],PDO::PARAM_STR);
    $ps->bindValue(4,$_SESSION['user']['id'],PDO::PARAM_INT);
    $ps->execute();
    }else{ //ないばあい
        $pdo = new PDO('mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1417495-yamasuta;charset=utf8', 'LAA1417495', 'sotA1140');
        $sql ="UPDATE user SET user_name=? ,self_introduction=? where user_id = ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$_POST['username'],PDO::PARAM_STR);
        $ps->bindValue(2,$_POST['introduction'],PDO::PARAM_STR);
        $ps->bindValue(3,$_SESSION['user']['id'],PDO::PARAM_STR);
        $ps->execute();
    }

    $sql ="SELECT * FROM user WHERE user_id=?"; //せションの再設定
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$_SESSION['user']['id'],PDO::PARAM_INT);
    $ps->execute();
    foreach($ps as $row){
        $_SESSION['user'] = ['id' => $row['user_id'], 'name' => $row['user_name'], 'mail' => $row['mail'], 'password' => $row['password'],
                             'iconmedia' => $row['icon'], 'introduction' => $row['self_introduction']];
    }

header('Location:06_profile.php');
?>