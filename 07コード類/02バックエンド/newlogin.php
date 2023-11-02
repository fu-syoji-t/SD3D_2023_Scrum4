<?php
session_start();

$email = $_POST['mail'];
$password = $_POST['password'];
$name = $_POST['username'];

$name_number = mb_strlen($name, 'UTF-8');
if($name_number >10){
    $_SESSION['error'] = "ユーザーネームは10文字未満までです。";
    header('Location:02_新規登録.php'); 
}else{

    $pdo = new PDO('mysql:host=localhost;dbname=yamasutagourmet;charset=utf8','root','root');

    //メールアドレス重複確認
    $sql="SELECT count(*) FROM user GROUP BY mail HAVING mail = ?";
    $ps=$pdo->prepare($sql);
    $ps->bindValue(1,$email,PDO::PARAM_STR);
    $ps->execute();
    foreach($ps as $row){
        $count = $row['count(*)'];
    }
}


    //＄countの中に数値が入っているか確認
    if(isset($count)){
        $_SESSION['error'] = "このメールアドレスはすでに使用されています。";
        header('Location:02_新規登録.php');  
    }else{
      
        //データベースに垢情報を登録
        $sql="INSERT INTO user(user_name, mail, password) VALUES(?,?,?)";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$name,PDO::PARAM_STR);
        $ps->bindValue(2,$email,PDO::PARAM_STR);
        $ps->bindValue(3,$password,PDO::PARAM_STR);
        $ps->execute();

        //セッションにユーザーIDを代入
        $sql="SELECT * FROM user WHERE mail = ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$email,PDO::PARAM_STR);
        $ps->execute();
        foreach($ps as $row){
            $_SESSION['user'] = ['id' => $row['user_id'], 'name' => $row['user_name'], 'mail' => $row['mail'], 'password' => $row['password'],
                                 'icon' => $row['icon'], 'introduction' => $row['self_introduction']];
        }

        header('Location:06_プロフィール.php');
    }
    
?>