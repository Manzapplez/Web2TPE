<?php
require_once './app/views/view.php';

class MovieView extends View{

    public function showMovies($movies){
        require './app/templates/list.movies.phtml';
    }
    public function showMovie($movie, $reviews){
        require './app/templates/detail.movie.phtml';
    }
}