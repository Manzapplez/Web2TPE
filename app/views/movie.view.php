<?php
require_once './app/views/view.php'

class MovieView extends View{

    function showMovies($movies){
        require './app/templates/list.movies.phtml';
    }
    function showMovie($movie){
        require './app/templates/detail.movie.phtml';
    }
}