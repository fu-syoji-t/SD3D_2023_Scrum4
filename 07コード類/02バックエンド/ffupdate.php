<?php

session_start();
$pdo = new PDO('mysql:host=localhost;dbname=yamasutagourmet;charset=utf8', 'root', 'root');


if ($_POST['follobtn'][1] == 10) { //フォロー一覧から遷移しフォロー一覧へ戻る

    if ($_POST['followbtn'][0] == 2) {

        $sql="SELECT * FROM user WHERE user_id = ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$_POST['followbtn'][2],PDO::PARAM_STR);
        $ps->execute();
        foreach($ps as $row){
            $partnaerid = $row['user_id'];
        }

        $sql = "DELETE FROM follow WHERE user_id = ? AND partner_id = ?";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $_SESSION['user']['id'], PDO::PARAM_INT);
        $ps->bindValue(2, $partnaerid/* 対象ユーザID */, PDO::PARAM_INT);
        $ps->execute();

        header('Location:13_FF一覧.php?follownum=' . $_POST['followbtn'][1]);
    }

    //フォローをやめる➔フォローする
    if ($_POST['followbtn'][0] == 1) {

        $sql="SELECT * FROM user WHERE user_id = ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$_POST['followbtn'][2],PDO::PARAM_STR);
        $ps->execute();
        foreach($ps as $row){
            $partnaerid = $row['user_id'];
        }

        $sql = "INSERT INTO follow(user_id, partner_id) VALUES(?,?)";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $_SESSION['user']['id'], PDO::PARAM_STR);
        $ps->bindValue(2, $partnaerid/* 対象ユーザID */, PDO::PARAM_STR);
        $ps->execute();
    }

    header('Location:13_フォロー一覧.php');
} else if ($_POST['follobtn'][1] == 20) { //フォロワー一覧から遷移しフォロワー一覧へ戻る

    if ($_POST['followbtn'][0] == 2) {

        $sql="SELECT * FROM user WHERE user_id = ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$_POST['followbtn'][2],PDO::PARAM_STR);
        $ps->execute();
        foreach($ps as $row){
            $partnaerid = $row['user_id'];
        }

        $sql = "DELETE FROM follow WHERE user_id = ? AND partner_id = ?";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $_SESSION['user']['id'], PDO::PARAM_INT);
        $ps->bindValue(2, $partnaerid/* 対象ユーザID */, PDO::PARAM_INT);
        $ps->execute();

        header('Location:13_FF一覧.php?follownum=' . $_POST['followbtn'][1]);
    }

    //フォローをやめる➔フォローする
    if ($_POST['followbtn'][0] == 1) {

        $sql="SELECT * FROM user WHERE user_id = ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$_POST['followbtn'][2],PDO::PARAM_STR);
        $ps->execute();
        foreach($ps as $row){
            $partnaerid = $row['user_id'];
        }

        $sql = "INSERT INTO follow(user_id, partner_id) VALUES(?,?)";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $_SESSION['user']['id'], PDO::PARAM_STR);
        $ps->bindValue(2, $partnaerid/* 対象ユーザID */, PDO::PARAM_STR);
        $ps->execute();
    }

    header('Location:13_フォロー一覧.php');

} else { //その他以外からの遷移
    if ($_POST['followbtn'][0] == 2) {

        $sql="SELECT * FROM user WHERE user_id = ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$_POST['followbtn'][2],PDO::PARAM_STR);
        $ps->execute();
        foreach($ps as $row){
            $partnaerid = $row['user_id'];
        }

        $sql = "DELETE FROM follow WHERE user_id = ? AND partner_id = ?";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $_SESSION['user']['id'], PDO::PARAM_INT);
        $ps->bindValue(2, $partnaerid/* 対象ユーザID */, PDO::PARAM_INT);
        $ps->execute();

        header('Location:///.php');
    }

    //フォローをやめる➔フォローする
    if ($_POST['followbtn'][0] == 1) {

        $sql="SELECT * FROM user WHERE user_id = ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$_POST['followbtn'][2],PDO::PARAM_STR);
        $ps->execute();
        foreach($ps as $row){
            $partnaerid = $row['user_id'];
        }

        $sql = "INSERT INTO follow(user_id, partner_id) VALUES(?,?)";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $_SESSION['user']['id'], PDO::PARAM_STR);
        $ps->bindValue(2, $partnaerid/* 対象ユーザID */, PDO::PARAM_STR);
        $ps->execute();
    }

    header('Location:///.php');
}
