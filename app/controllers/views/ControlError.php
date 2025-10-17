<?php
class ControlError
{
    // Muestra error 404 (Página no encontrada)
    public function show404(): void
    {
        require_once __DIR__ . '/../../views/errors/404View.php';
    }

    // Muestra error 500 (Error interno del servidor)
    public function show500(): void
    {
        require_once __DIR__ . '/../../views/errors/500View.php';
    }
}
