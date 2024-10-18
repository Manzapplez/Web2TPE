<?php
require_once './app/helpers/db.helper.php';

class UserModel {
    protected $db;
    
    public function __construct() {
        DbHelper::tryCreateDB();
        $this->db = new PDO(DB_CONNECT_STRING, DB_USER, DB_PASS);
        DbHelper::deploy($this->db);
    }

    public function getByUser($user) {
        $query = $this->db->prepare('SELECT * FROM users WHERE user=?');
        $query->execute([$user]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}