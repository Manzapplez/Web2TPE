<?php
require_once './app/helpers/db.helper.php';

class Model{
    protected $db;

    public function __construct() {
        DbHelper::tryCreateDB();
        $this->db = new PDO(DB_CONNECT_STRING, DB_USER, DB_PASS);
        DbHelper::deploy($this->db);
    }
}