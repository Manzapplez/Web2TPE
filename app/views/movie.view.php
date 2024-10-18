<?php
class MovieView{

    function __construct(){

    }
    function showMovies($movies){
        require './app/templates/list.movies.phtml';
    }
    function showMovie($movie){
        require './app/templates/detail.movie.phtml';
    }
}