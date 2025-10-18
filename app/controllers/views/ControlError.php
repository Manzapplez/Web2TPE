<?php
class ControlError
{
    public function failedLogin(): void
    {
        // require_once __DIR__ . '/../../views/errors/loginError.phtml';
        echo "Usuario o contraseña incorrectos.";
    }

    // Muestra error 404 (Página no encontrada)
    public function show404(): void
    {
        // require_once __DIR__ . '/../../views/errors/404View.php';
        echo "Página no encontrada.";
    }

    // Muestra error 500 (Error interno del servidor)
    public function show500(): void
    {
        // require_once __DIR__ . '/../../views/errors/500View.php';
        echo "Error interno del servidor.";
    }

   
    public function accessDenied(): void
    {
        echo "Acceso denegado. Inicie sesión para continuar.";
    }
}
