<?php

require_once './app/models/movie.model.php'
require_once './app/models/review.model.php'
require_once './app/models/movie.view.php'

class MovieController{
    private $movieModel;
    private $movieView;
    private $reviewModel;

    public function __construct(){
        $this->movieModel = new MovieModel();
        $this->movieView = new MovieView();
        $this->reviewModel = new ReviewModel();
    }

    public function showMovies(){
            $movies = $this->movieModel->getMovies();
            $this->movieView->showMovies($movies);
    }

    public function showMovie($id){
        $movie = $this->movieModel->getMovie($id);
        $reviews = $this->reviewModel->getMovieReviews($id);
        $this->movieView->showMovie($movie, $reviews);
    }

    public function addMovie(){
        AuthHelper::verify();

        $title = $_POST['title'];
        $director = $_POST['director'];
        $synopsis = $_POST['synopsis'];
        $release_date = $_POST['release_date'];
        $runtime = $_POST['runtime'];
        $genre = $_POST['genre'];

        $this->movieModel->addMovie($title,$director,$synopsis,$release_date,$runtime,$genre);
    }
    public function editMovie($id){
        AuthHelper::verify();

        $title = $_POST['title'];
        $director = $_POST['director'];
        $synopsis = $_POST['synopsis'];
        $release_date = $_POST['release_date'];
        $runtime = $_POST['runtime'];
        $genre = $_POST['genre'];

        $this->movieModel->editMovie($title,$director,$synopsis,$release_date,$runtime,$genre,$id);
    }
    public function removeMovie($id){
        AuthHelper::verify();

        $this->movieModel->deleteMovie($id);
    }
}