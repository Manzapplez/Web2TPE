<?php
class MovieModel{
    protected $db;

    public function __construct() {
        DbHelper::tryCreateDB();
        $this->db = new PDO(DB_CONNECT_STRING, DB_USER, DB_PASS);
        DbHelper::deploy($this->db);
    }

    public function getMovies() {
        $query = $this->db->prepare('SELECT * FROM movies ORDER BY title');
        $query->execute();
        
        $movies = $query->fetchAll(PDO::FETCH_OBJ);
        return $movies;
    }

    public function getMovie($id) {
        $query = $this->db->prepare('SELECT * FROM movies WHERE id_movie=?');
        $query->execute([$id]);
        
        $movie = $query->fetch(PDO::FETCH_OBJ);
        return $movie;
    }
}