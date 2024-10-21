<?php
require_once './app/views/view.php';

class MovieView extends View{

    public function showMovies($movies){
        $form= './app/templates/form.add.movie.phtml';
        require './app/templates/list.movies.phtml';
    }
    public function showMovie($movie, $reviews){
        require './app/templates/detail.movie.phtml';
    }
    public function editMovieForm($movie, $movies){
        $form = './app/templates/form.edit.movie.phtml';
        require './app/templates/list.movies.phtml';
    }
}