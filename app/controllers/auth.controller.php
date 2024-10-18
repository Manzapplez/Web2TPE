<?php

require_once './app/models/user.model.php'
require_once './app/models/auth.view.php'

class AuthController{
    private $view;
    private $controller;

    function __construct(){
        $this->view = new AuthView();
        $this->model = new UserModel();
    }
    function login(){
        $this->view->showLogin();
    }
    function auth(){

    }
    function logout(){

    }
}