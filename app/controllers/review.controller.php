<?php

require_once './app/models/review.model.php';
require_once './app/views/review.view.php';

class reviewController{
    private $reviewModel;
    private $movieModel;
    private $reviewView;


    public function __construct(){
        $this->reviewModel = new ReviewModel();
        $this->movieModel = new MovieModel();
        $this->reviewView = new ReviewView();
    }

    public function showReviews(){
            $reviews = $this->reviewModel->getReviews();
            $movies = $this->movieModel->getMovies();
            $this->reviewView->showReviews($reviews, $movies);
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
        header('Location: ' . BASE_URL . 'reviews');
    }
    public function editReviewForm($id){
        $review = $this->reviewModel->getReview($id);
        $reviews = $this->reviewModel->getReviews();
        $movies = $this->movieModel->getMovies();
        $this->reviewView->editReviewForm($review, $reviews, $movies);
    }

    public function editReview($id){
        AuthHelper::verify();

        $id_movie = $_POST['id_movie'];
        $body = $_POST['body'];
        $rating = $_POST['rating'];

        $this->reviewModel->editReview($id_movie,$body,$rating, $id);
        header('Location: ' . BASE_URL . 'reviews');
    }
    public function removeReview($id){
        AuthHelper::verify();
        $this->reviewModel->deleteReview($id);
        header('Location: ' . BASE_URL . 'reviews');
    }
}