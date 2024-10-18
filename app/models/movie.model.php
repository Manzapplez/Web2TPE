<?php
class MovieModel{
    protected $db;

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