<?php
class ErrorView
{
    // Error al intentar iniciar sesión con usuario o contraseña incorrectos
    public static function showInvalidCredentials(): void
    {
        require_once './app/templates/home/header.phtml';
        //  require_once './app/templates/home/nav.phtml'; (da error por las variable utilizadas en el template)
        require_once './app/templates/home/login.phtml';
        echo "Usuario o contraseña incorrectos."; //en rojo
        require_once './app/templates/home/article.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    // Error al subir foto de perfil
    public static function showPhotoUploadError(): void
    {
        // require_once __DIR__ . '/../../views/errors/photoUploadError.phtml';
        echo "Error al subir la foto de perfil.";
    }

    // Usuario no encontrado
    public static function showUserNotFound(): void
    {
        // require_once __DIR__ . '/../../views/errors/userNotFound.phtml';
        echo "Usuario no encontrado.";
    }

    // Error genérico
    public static function showError(): void
    {
        // require_once __DIR__ . '/../../views/errors/genericError.phtml';
        echo "Ha ocurrido un error. Intente nuevamente.";
    }

    // Muestra error 404 (Página no encontrada)
    public static function show404(): void
    {
        // require_once __DIR__ . '/../../views/errors/404View.php';
        echo "Página no encontrada.";
    }

    // Muestra error 500 (Error interno del servidor)
    public static function show500(): void
    {
        // require_once __DIR__ . '/../../views/errors/500View.php';
        echo "Error interno del servidor.";
    }

    // Acceso denegado
    public static function accessDenied(): void
    {
        // require_once __DIR__ . '/../../views/errors/accessDenied.phtml';
        echo "Acceso denegado. Inicie sesión para continuar.";
    }

    public static function showSuccess(): void {}
    public static function showCoverUploadError(): void
    {
        echo "Error al subir la imagen de perfil. Por favor, intenta nuevamente.</p>";
    }

    public static function failedLogin() {
        
    }
}
