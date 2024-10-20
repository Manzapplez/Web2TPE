<?php
require_once './app/models/model.php';

class reviewModel extends Model{

    // En esta funcion ademas de agarrar las reviews tomamos el titulo de las peliculas
    // asi lo podemos mostrar mas facil :3
    public function getReviews() {
        $query = $this->db->prepare('
            SELECT reviews.*, movies.title 
            FROM reviews 
            JOIN movies ON reviews.id_movie = movies.id_movie 
            ORDER BY reviews.id_movie
        ');
        $query->execute();
        
        $reviews = $query->fetchAll(PDO::FETCH_OBJ);
        return $reviews;
    }

    public function getMovieReviews($movieId){
        $query = $this->db->prepare('SELECT * FROM reviews WHERE id_movie=? ORDER BY id_movie');
        $query->execute([$movieId]);
        
        $reviews = $query->fetchAll(PDO::FETCH_OBJ);
        return $reviews;
    }

    // aca tambien
    public function getReview($id) {
        $query = $this->db->prepare('SELECT * FROM reviews WHERE id_review=?');
        $query->execute([$id]);
        
        $review = $query->fetch(PDO::FETCH_OBJ);
        if ($review) {
            $movieQuery = $this->db->prepare("SELECT title FROM movies WHERE id_movie = ?");
            $movieQuery->execute([$review->id_movie]);
            $movie = $movieQuery->fetch(PDO::FETCH_OBJ);
            $review->title = $movie ? $movie->title : null;
        }

        return $review;
    }

    public function addReview($id_movie, $body, $rating){
        $query = $this->db->prepare('INSERT INTO reviews (id_movie, body, rating) VALUES (?,?,?)');
        $query->execute([$id_movie, $body, $rating]);
    }

    public function editReview($id_movie,$body,$rating, $id){
        $query = $this->db->prepare('UPDATE reviews SET id_movie=?, body=?, rating=? WHERE id_review=?');
        $query->execute([$id_movie, $body, $rating, $id]);
    }

    public function deleteReview($id){
        $query = $this->db->prepare('DELETE FROM reviews WHERE id_review=?');
        $query->execute([$id]);
    }

}