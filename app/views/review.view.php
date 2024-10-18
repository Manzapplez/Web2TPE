<?php
review
class ReviewView{

    function __construct(){

    }
    function showReviews($reviews){
        require './app/templates/list.reviews.phtml';
    }
    function showReview($review){
        require './app/templates/detail.review.phtml';
    }
}