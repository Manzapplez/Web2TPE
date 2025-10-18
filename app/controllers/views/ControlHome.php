<?php
require_once __DIR__ . '/../../views/viewHome/ViewHome.php';
require_once __DIR__ . '/../auth/AuthController.php';

class ControlHome
{
    private ViewHome $viewHome;
    private AuthController $auth;

    public function __construct()
    {
        $this->viewHome = new ViewHome();
        $this->auth = new AuthController();
    }

    public function showHome(): void
    {
        $this->viewHome->showHome();
    }

    public function showLogin(): void
    {
        $this->viewHome->showLogin();
    }

    public function showLoginIn(): void
    {
        $this->auth->logInUser();
        //invoca el metodo del Auth para procesar los parametros enviados por el formulario

        /*  $this->viewHome->showLogin();*/
    }

    public function showRegister(): void
    {
        $this->viewHome->showRegister();
    }
}
