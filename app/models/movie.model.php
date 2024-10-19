<?php
require_once './app/models/model.php';

class MovieModel extends Model {

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

    public function addMovie($title,$director,$synopsis,$release_date,$runtime,$genre){
        $query = $this->db->prepare('INSERT INTO movies (title, director, synopsis, release_date, runtime, genre) VALUES (?, ?, ?, ?, ?, ?)');
        $query->execute([$title,$director,$synopsis,$release_date,$runtime,$genre]);
    }
    public function editMovie($title,$director,$synopsis,$release_date,$runtime,$genre,$id){
        $query = $this->db->prepare('UPDATE movies SET title=?, director=?, synopsis=?, release_date=?, runtime=?, genre=? WHERE id_movie=?');
        $query->execute([$title,$director,$synopsis,$release_date,$runtime,$genre,$id]);
    }
    public function deleteMovie($id){
        $query = $this->db->prepare('DELETE FROM movies WHERE id_movie=?');
        $query->execute([$id]);
    }
}