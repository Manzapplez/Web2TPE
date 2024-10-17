<?php

require_once './app/models/movie.model.php'
require_once './app/models/movie.view.php'

class MovieController{
    private $movieModel;
    private $movieView;


    function __construct(){
        this->movieModel = new movieModel();
        this->movieView = new movieView();
    }
}