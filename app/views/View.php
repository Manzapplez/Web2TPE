<?php
require_once './app/controllers/AuthController.php';

class View
{
    private AuthController $auth;

    public function __construct()
    {
        $this->auth = new AuthController();
    }

    public function showHome(): void
    {
        $user = $_SESSION['user'] ?? null;
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/home/article.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    public function showAdmin(): void
    {
        $user = $_SESSION['user'] ?? null;
        require_once './app/templates/home/header.phtml';
        //podria haber un nav entre abm de artistas, canciones, usuarios
        require_once './app/templates/admin/artAdmin.phtml';
        require_once './app/templates/admin/sectionArtist.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    public function showLogin(): void
    {
        $user = $_SESSION['user'] ?? null;
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/home/login.phtml';
        require_once './app/templates/home/article.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    public function showLoginIn(): void
    {
        //no existe session activa, invoca showHome
        //existe session activa actualiza que cosa?
        /*  $this->viewHome->showLogin();*/
    }

    public function showRegister(): void
    {
        $user = $_SESSION['user'] ?? null;
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/home/register.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    public function showUserAlreadyExists(string $name): void
    {
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/home/register.phtml';
        echo "el nombre ya existe pruebe con otro"; // en rojo
        require_once './app/templates/home/footer.phtml';
    }

    public function showEmailAlreadyExists(string $email): void
    {
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/home/register.phtml';
        echo "el correo ya esta en uso pruebe con otro"; // en rojo
        require_once './app/templates/home/footer.phtml';
    }

    public function showLoginSuccess(): void
    {
        $user = $_SESSION['user'] ?? null;
        require_once './app/templates/home/header.phtml';
        //  require_once './app/templates/home/nav.phtml'; (da error por las variable utilizadas en el template)
        echo "inisio de session con exitoso"; //en verde

        //deberia cambiar si el usuario logueado es administrador
        /*
        require_once './app/templates/home/article.phtml';*/

        require_once './app/templates/home/footer.phtml';
    }

    public function showUserProfile($user): void
    {
        require_once __DIR__ . '/../templates/templatesUser/profile.phtml';
    }

    public function showSuccess(): void
    {
        require_once './app/templates/home/header.phtml';
        //  require_once './app/templates/home/nav.phtml'; (da error por las variable utilizadas en el template)
        echo "Usuario registrado con exito"; //en verde

        //deberia cambiar si el usuario logueado es administrador
        /*
        require_once './app/templates/home/article.phtml';*/

        require_once './app/templates/home/footer.phtml';
    }
}
