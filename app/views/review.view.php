<?php
require_once './app/views/view.php';

class ReviewView extends View{

    function showReviews($reviews){
        require './app/templates/list.reviews.phtml';
    }
    function showReview($review){
        require './app/templates/detail.review.phtml';
    }
}