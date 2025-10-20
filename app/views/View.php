<?php

class View
{
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

    public function showRegister(): void
    {
        $user = $_SESSION['user'] ?? null;
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/home/register.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    public function showSuccess(): void
    {
        $user = $_SESSION['user'] ?? null;
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/messages/showSuccess.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    public function userProfile($user) {}
}
