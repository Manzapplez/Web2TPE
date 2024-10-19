<?php
require_once './app/models/model.php'

class reviewModel extends Model{

    public function getReviews() {
        $query = $this->db->prepare('SELECT * FROM reviews ORDER BY id_movie');
        $query->execute();
        
        $reviews = $query->fetchAll(PDO::FETCH_OBJ);
        return $reviews;
    }

    public function getReview($id) {
        $query = $this->db->prepare('SELECT * FROM reviews WHERE id_review=?');
        $query->execute([$id]);
        
        $review = $query->fetch(PDO::FETCH_OBJ);
        return $review;
    }
}