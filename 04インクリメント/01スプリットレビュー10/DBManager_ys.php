<?php
class DBManager{
    private function dbConnect(){
        $pdo = new PDO('mysql:host=localhost;dbname=yamasutagourmet;charset=utf8', 'root', 'root');

        return $pdo;
    }

    public function user_search(){//ユーザーを全部検索するよ！

        $pdo = $this->dbConnect();
        $sql = "select * from user";
        $ps=$pdo->prepare($sql);
        $ps->execute();
        $searchArray = $ps->fetchAll();
        return $searchArray;
    }

}

?>