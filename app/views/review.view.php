<?php
require_once './app/views/view.php';

class ReviewView extends View{

    public function showReviews($reviews){
        require './app/templates/list.reviews.phtml';
    }
    public function showReview($review){
        require './app/templates/detail.review.phtml';
    }
}