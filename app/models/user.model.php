<?php
require_once './app/models/model.php';

class UserModel extends Model{

    public function getByUser($user) {                    //trae el user de la db
        $query = $this->db->prepare('SELECT * FROM users WHERE user=?');
        $query->execute([$user]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}