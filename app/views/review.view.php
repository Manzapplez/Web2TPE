<?php
require_once './app/views/view.php';

class ReviewView extends View{

    public function showReviews($reviews, $movies){
        $form= './app/templates/form.add.review.phtml';
        require './app/templates/list.reviews.phtml';
    }
    public function showReview($review){
        require './app/templates/detail.review.phtml';
    }
    public function editReviewForm($review, $reviews, $movies){
        $form = './app/templates/form.edit.review.phtml';
        require './app/templates/list.reviews.phtml';
    }
}