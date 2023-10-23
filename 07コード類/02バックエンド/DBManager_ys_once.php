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

    public function post(){//投稿を全部検索するよ！

        $pdo = $this->dbConnect();
        $sql = "select * from post_2";
        $ps=$pdo->prepare($sql);
        $ps->execute();
        $searchArray = $ps->fetchAll();
        return $searchArray;
    }
}

?>