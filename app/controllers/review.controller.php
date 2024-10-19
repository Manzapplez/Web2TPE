<?php

require_once './app/models/review.model.php'
require_once './app/models/review.view.php'

class reviewController{
    private $reviewModel;
    private $reviewView;


    public function __construct(){
        $this->reviewModel = new ReviewModel();
        $this->reviewView = new ReviewView();
    }

    public function showReviews(){
            $reviews = $this->reviewModel->getReviews();
            $this->reviewView->showReviews($reviews);
    }

    public function showReview($id){
        $review = $this->reviewModel->getReview($id);
        $this->reviewView->showReview($review);
    }

    public function addReview(){
        AuthHelper::verify();

        $id_movie = $_POST['id_movie'];
        $body = $_POST['body'];
        $rating = $_POST['rating'];

        $this->reviewModel->addReview($id_movie,$body,$rating);
    }

    public function editReview($id){
        AuthHelper::verify();

        $id_movie = $_POST['id_movie'];
        $body = $_POST['body'];
        $rating = $_POST['rating'];

        $this->reviewModel->editReview($id_movie,$body,$rating, $id);
    }
    public function removeReview($id){
        AuthHelper::verify();
        $this->reviewModel->deleteReview($id)
    }
}