<?php
class ErrorView
{
    public static function photoUploadError(): void
    {
        $user = $_SESSION['user'] ?? null;
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/messages/photoUploadError.phtml';
        require_once './app/templates/home/register.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    public static function coverUploadError(): void
    {
        $user = $_SESSION['user'] ?? null;
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/messages/coverUploadError.phtml';
        require_once './app/templates/home/register.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    public static function show404(): void
    {
        require_once './app/templates/messages/show404.phtml';
    }

    public static function show500(): void
    {
        require_once './app/templates/messages/show500.phtml';
    }

    public static function failedLogin(): void
    {
        $user = $_SESSION['user'] ?? null;
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/messages/failedLogin.phtml';
        require_once './app/templates/home/login.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    public static function userAlreadyExists(): void
    {
        $user = $_SESSION['user'] ?? null;
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/messages/userAlreadyExist.phtml';
        require_once './app/templates/home/register.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    public static function emailAlreadyExists(): void
    {
        $user = $_SESSION['user'] ?? null;
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/messages/emailAlreadyExists.phtml';
        require_once './app/templates/home/register.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    public static function showError(): void
    {
        $user = $_SESSION['user'] ?? null;
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/messages/genericError.phtml';
        require_once './app/templates/admin/sectionArtist.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    public static function userNotFound() {}
}
