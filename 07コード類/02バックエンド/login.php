<?php

session_start();

$pdo = new PDO('mysql:host=localhost;dbname=yamasutagourmet;charset=utf8', 'root', 'root');
$sql = "SELECT *, count(*) FROM user WHERE mail=?";
$ps = $pdo->prepare($sql);
$ps->bindValue(1, $_POST['mail'], PDO::PARAM_STR);
$ps->execute();
$searchArray = $ps->fetchAll();

foreach ($searchArray as $row) {
    if($row['count(*)'] == 0){
        $_SESSION['error'] = "メールアドレスまたはパスワードが一致しません。1";
        echo $_SESSION['error'];
        header('Location:01_ログイン.php');
        break;
    }
    if ($_POST['password'] == $row['password']) {
        $_SESSION['user'] = ['id' => $row['user_id'], 'name' => $row['user_name'], 'mail' => $row['mail'], 'password' => $row['password'],
                             'iconmedia' => $row['icon'], 'introduction' => $row['self_introduction']];
        echo $_SESSION['error'];
        header('Location:06_プロフィール.php');

    }else{       
        $_SESSION['error'] = "メールアドレスまたはパスワードが一致しません。2";
        echo $_SESSION['error'];
            header('Location:01_ログイン.php') ;
        }
    }
?>































