<?php
class DBManager{
    private function dbConnect(){
        $pdo = new PDO('mysql:host=localhost;dbname=yamasutagourmet;charset=utf8', 'root', 'root');

        return $pdo;
    }

    public function user($user_id){//ユーザーを全部検索するよ！

        $pdo = $this->dbConnect();
        $sql = "select * from user where user_id = ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$user_id,PDO::PARAM_INT);
        $ps->execute();
        $searchArray = $ps->fetchAll();
        return $searchArray;
    }

    public function post_select(){//投稿を全部検索するよ！

        $pdo = $this->dbConnect();
        $sql = "select * from post";
        $ps=$pdo->prepare($sql);
        $ps->execute();
        $searchArray = $ps->fetchAll();
        return $searchArray;
    }

    public function post_new($id,$text,$date,$region){//画像以外の情報とpost_idを撮ってくるよ
        $pdo = $this->dbConnect();
        $sql = "INSERT INTO `post`( `user_id`, `post_contents`, `date_time`, `region`) VALUES (?,?,?,?)";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$id,PDO::PARAM_INT);
        $ps->bindValue(2,$text,PDO::PARAM_STR);
        $ps->bindValue(3,$date,PDO::PARAM_STR);
        $ps->bindValue(4,$region,PDO::PARAM_STR);
        $ps->execute();
        
        $pdo = $this->dbConnect();
        $sql = "select max(post_id) from post where user_id = ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$id,PDO::PARAM_INT);
        $ps->execute();
        $searchArray = $ps->fetchAll();
        return $searchArray;
    }
}

?>