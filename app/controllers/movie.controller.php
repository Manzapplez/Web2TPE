<?php

require_once './app/models/movie.model.php'
require_once './app/models/movie.view.php'

class MovieController{
    private $movieModel;
    private $movieView;


    function __construct(){
        this->movieModel = new MovieModel();
        this->movieView = new MovieView();
    }

    function showMovies(){
            $movies = $this->movieModel->getMovies();
            $this->movieView->showMovies($movies);
    }

    function showMovie($id){
        $movie = $this->movieModel->getMovie($id);
        $this->movieView->showMovie($movie);
    }
}