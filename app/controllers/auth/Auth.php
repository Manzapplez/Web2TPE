<?php

require_once './app/views/AuthView.php';
require_once './app/models/UserModel.php';

class AuthController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->view = new AuthView();
        $this->model = new UserModel();
    }

    // MUESTRA EL FORM DE LOGIN
    public function login()
    {
        // if (AuthHelper::check()) {
        //     header('Location: ' . BASE_URL . 'songs');
        //     exit;
        // }
        $this->view->showLogin();
    }

    //alternativa
     public function logInUser() {
        $userName = $_POST["userName"];
        $userPassword = $_POST["userPassword"];
        
        if (($this->userNameCorrect($userName))) {
            if ($this->passwordVerify($userName,$userPassword)) {
                $this->newUser();
            } else {
                $this->failedLogin();   
            }
        } else { 
            $this->failedLogin();   
        }
    }

    // PROCESA EL FORM LOGIN
    public function auth()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            $this->view->showLogin('Faltan completar datos');
            return;
        }

        // busca el user por usname
        $user = $this->model->getByUser($username);
        // if (!$user) {
        //     $this->view->showLogin('Usuario no encontrado');
        //     return;
        // }

        // verifica passwd
        if (password_verify($password, $user->password)) {
            AuthHelper::login($user);
            header('Location: ' . BASE_URL);
            exit;
        } else {
            $this->view->showLogin('Contraseña incorrecta');
        }
    }

    public function logout()
    {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);
        exit;
    }
}