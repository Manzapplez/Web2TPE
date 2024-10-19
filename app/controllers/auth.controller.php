<?php

require_once './app/models/user.model.php';
require_once './app/models/auth.view.php';
require_once './app/helpers/auth.helper.php';

class AuthController{
    private $model;
    private $view;

    public function __construct(){
        $this->view = new AuthView();
        $this->model = new UserModel();
    }   
    public function login(){
        $this->view->showLogin();
    }
    public function auth(){
        $user= $_POST['user'];          //se reciben user y pass enviados por POST del form
        $password = $_POST['password'];

        if (empty($user) || empty($password)) {
            $this->view->showLogin('Faltan completar datos');
            return;
        }

        $user = $this->model->getByUser($user);
        if ($user && password_verify($password, $user->password)) { //checkeamos que el user este en la db
            AuthHelper::login($user);
            header('Location: ' . BASE_URL . 'albums');
        } else {
            $this->view->showLogin('Usuario y/o contraseña inválidos');
        }
    }
    public function logout(){
        AuthHelper::logout();
        header('Location: ' . BASE_URL . 'albums');    
    }
}