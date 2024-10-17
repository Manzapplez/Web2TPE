<?php
class MovieView{

    function __construct(){

    }
    function showMovies($movies){
        require './app/templates/list.movies.phtml';
    }
}