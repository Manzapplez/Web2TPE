<?php

require_once './app/models/review.model.php'
require_once './app/models/review.view.php'

class reviewController{
    private $reviewModel;
    private $reviewView;


    function __construct(){
        this->reviewModel = new ReviewModel();
        this->reviewView = new ReviewView();
    }

    function showreviews(){
            $reviews = $this->reviewModel->getreviews();
            $this->reviewView->showreviews($reviews);
    }

    function showreview($id){
        $review = $this->reviewModel->getreview($id);
        $this->reviewView->showreview($review);
    }
}