<?php
require_once './app/models/model.php'

class reviewModel extends Model{

    public function getReviews() {
        $query = $this->db->prepare('SELECT * FROM reviews ORDER BY id_movie');
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

    public function getReview($id) {
        $query = $this->db->prepare('SELECT * FROM reviews WHERE id_review=?');
        $query->execute([$id]);
        
        $review = $query->fetch(PDO::FETCH_OBJ);
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