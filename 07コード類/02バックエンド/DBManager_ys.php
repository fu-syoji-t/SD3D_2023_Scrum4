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

    public function post_select($user_id){//投稿を全部検索するよ！

        $pdo = $this->dbConnect();
        $sql = "select * from post where user_id in (select partner_id from follow where user_id = ?)";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$user_id,PDO::PARAM_INT);
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

    public function post_zip($id, $zip, $number) {
        $pdo = $this->dbConnect();
        $column_name = 'media' . $number;
        $sql = "UPDATE post SET $column_name = :zip WHERE post_id = :id";
        $ps = $pdo->prepare($sql);
        $ps->bindParam(':zip', $zip, PDO::PARAM_LOB);
        $ps->bindParam(':id', $id, PDO::PARAM_INT);
        $ps->execute();
    }

    public function ff_delete($user_id,$partner_id){
        $pdo = $this->dbConnect();
        $sql = "DELETE FROM follow WHERE user_id = ? and partner_id = ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$user_id,PDO::PARAM_INT);
        $ps->bindValue(2,$partner_id,PDO::PARAM_INT);
        $ps->execute();
    }

    public function ff_insert($user_id,$partner_id){
        $pdo = $this->dbConnect();
        $sql = "insert into follow(user_id,partner_id) values(?,?)";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$user_id,PDO::PARAM_INT);
        $ps->bindValue(2,$partner_id,PDO::PARAM_INT);
        $ps->execute();
    }

    public function user_icon($user_id){ //アイコンを設定する
        $pdo = $this->dbConnect();
        $sql = "select icon from user where user_id = ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$user_id,PDO::PARAM_INT);
        $ps->execute();
        $searchArray = $ps->fetchAll();
        return $searchArray;
    }

    public function dm_list_select($user_id){
        $pdo = $this->dbConnect();
        $sql = "select * from dm where user_id1 = ? or user_id2 = ? "; //昇順に表示
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$user_id,PDO::PARAM_INT);
        $ps->bindValue(2,$user_id,PDO::PARAM_INT);
        $ps->execute();
        $searchArray = $ps->fetchAll();
        return $searchArray;
    }

    public function dm_id_select($user_id,$partner_id){
        $pdo = $this->dbConnect();
        $sql = "select * from dm where (user_id1 = ? and user_id2 = ?) or (user_id1 = ? and user_id2 = ?)";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$user_id,PDO::PARAM_INT);
        $ps->bindValue(2,$partner_id,PDO::PARAM_INT);
        $ps->bindValue(3,$partner_id,PDO::PARAM_INT);
        $ps->bindValue(4,$user_id,PDO::PARAM_INT);
        $ps->execute();
        $searchArray = $ps->fetchAll();
        return $searchArray;
    }

    //メッセージを検索する
    public function message_select($dm_id){
        $pdo = $this->dbConnect();
        $sql = "select * from message where dm_id = ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$dm_id,PDO::PARAM_INT);
        $ps->execute();
        $searchArray = $ps->fetchAll();
        return $searchArray;
    }


    //dmを追加する
    public function dm_insert($user_id,$dm_id,$message){
        //message_numberを取得する
        $pdo = $this->dbConnect();
        $sql = "select max(message_number) from message where dm_id = ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$dm_id,PDO::PARAM_INT);
        $ps->execute();

        foreach($ps as $row){
            $message_number = $row['max(message_number)'];
            $message_number = +1; //メッセージの数を増やす
        }

        $pdo = $this->dbConnect();
        $sql = "INSERT INTO `message`( `dm_id`, `message_number`, `user_id`, `message`) VALUES (?,?,?,?)";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$dm_id,PDO::PARAM_INT);
        $ps->bindValue(2,$message_number,PDO::PARAM_INT);
        $ps->bindValue(3,$user_id,PDO::PARAM_INT);
        $ps->bindValue(4,$message,PDO::PARAM_STR);
        $ps->execute();

        //dmのreadを更新する
        $pdo = $this->dbConnect();
        $sql = "update dm set dm_read = ? where dm_id = ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$user_id,PDO::PARAM_INT);
        $ps->bindValue(2,$dm_id,PDO::PARAM_INT);
        $ps->execute();
    }


    //dmテーブルを新しく作ってdm_idを返す
    public function dm_new_table($user_id,$partner_id){
        $pdo = $this->dbConnect();
        $sql = "INSERT INTO `dm`(`user_id1`, `user_id2`, `dm_read`) VALUES (?,?,?)";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$user_id,PDO::PARAM_INT);
        $ps->bindValue(2,$partner_id,PDO::PARAM_INT);
        $ps->bindValue(3,$user_id,PDO::PARAM_INT);
        $ps->execute();

        //dm_idを取得
        $pdo = $this->dbConnect();
        $sql = "select * from dm where (user_id1 = ? and user_id2 = ?) or (user_id1 = ? and user_id2 = ?)";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$user_id,PDO::PARAM_INT);
        $ps->bindValue(2,$partner_id,PDO::PARAM_INT);
        $ps->bindValue(3,$partner_id,PDO::PARAM_INT);
        $ps->bindValue(4,$user_id,PDO::PARAM_INT);
        $ps->execute();
        $searchArray = $ps->fetchAll();
        return $searchArray;
    }

    //dmテーブルを作成後に初投稿を登録
    public function dm_new_insert($dm_id,$user_id,$message){
        $pdo = $this->dbConnect();
        $sql = "INSERT INTO `message`(`dm_id`,`user_id`, `message`) VALUES (?,?,?)";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$dm_id,PDO::PARAM_INT);
        $ps->bindValue(2,$user_id,PDO::PARAM_INT);
        $ps->bindValue(3,$message,PDO::PARAM_STR);
        $ps->execute();
    }

    //既読機能
    public function dm_read($dm_id,$user_id){
        $pdo = $this->dbConnect();
        $sql = "update dm set dm_read = ? where dm_id = ? and dm_read != ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,0,PDO::PARAM_INT);
        $ps->bindValue(2,$dm_id,PDO::PARAM_INT);
        $ps->bindValue(3,$user_id,PDO::PARAM_INT);
        $ps->execute();
    }

    public function move_post($post_id){
        $pdo = $this->dbConnect();
        $sql = "select * from post where post_id = ?";
        $ps=$pdo->prepare($sql);
        $ps->bindValue(1,$post_id,PDO::PARAM_INT);
        $ps->execute();
        $searchArray = $ps->fetchAll();
        return $searchArray;
    }
}

?>