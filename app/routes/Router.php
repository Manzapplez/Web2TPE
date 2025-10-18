<?php
require_once __DIR__ . '/../controllers/views/ControlAdmin.php';
require_once __DIR__ . '/../controllers/views/ControlHome.php';
require_once __DIR__ . '/../controllers/views/ControlError.php';

class Router
{
    private ControlHome $controlHome;
    private ControlAdmin $controlAdmin;
    private ControlError $controlError;
    private string $action;

    private static string $baseUrl;

    // Rutas accesibles para cualquier usuario
    private const ROUTES = [
        'home'          => 'showHome',
        'login'         => 'showLogin',
        'logIn'         => 'showLoginIn',
        'register'      => 'showRegister',
    ];

    // Rutas exclusivas para administradores
    private const ADMIN_ROUTES = [
        'admin'        => 'showAdmin',
        'addArtist'    => 'insertArtist',
        'updateArtist' => 'updateArtist',
        'deleteArtist' => 'deleteArtistByName'
    ];

    public function __construct()
    {
        // Instancia los controladores de vista
        $this->controlHome = new ControlHome();
        $this->controlAdmin = new ControlAdmin();
        $this->controlError = new ControlError();

        // Define la URL base de la aplicación
        self::defineBaseUrl();

        // Define la acción solicitada por el usuario
        $this->defineAction();
    }

    // Método estático para calcular la URL base de la aplicación
    private static function defineBaseUrl(): void
    {
        self::$baseUrl = '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT']
            . dirname($_SERVER['PHP_SELF']) . '/';
    }

    // Devuelve la URL base de la aplicación
    public static function getBaseUrl(): string
    {
        return self::$baseUrl;
    }

    // Define la acción solicitada a partir de la variable $_GET['action']
    private function defineAction(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $base = dirname($_SERVER['PHP_SELF']);
        $path = trim(substr($uri, strlen($base)), '/');
        $this->action = $path ?: 'home';
    }

    // Evalúa la acción solicitada y llama al método correspondiente del controlador de vista
    public function evaluateAction(): void
    {
        // Verifica si hay usuario logueado y es administrador
        $isAdmin = isset($_SESSION['username']) && $_SESSION['username'] === 'administrador';

        // Separa la acción por '/' para soportar sub-rutas
        $parse = explode("/", $this->action);
        $route = $parse[0];

        // Verifica si la ruta existe en el array de rutas válidas
        if (!array_key_exists($route, self::ROUTES) && !array_key_exists($route, self::ADMIN_ROUTES)) {
            $this->controlError->show404();
            return;
        }

        if (array_key_exists($route, self::ADMIN_ROUTES)) {
            if (!$isAdmin) {
                echo "no es administrador";
                $this->controlError->show404();
                return;
            }
            $method = self::ADMIN_ROUTES[$route];
            if (method_exists($this->controlAdmin, $method)) {
                $this->controlAdmin->$method();
            } else {
                $this->controlError->show500();
            }
        } else {
            // Si no es administrador, usamos el controlador general
            $method = self::ROUTES[$route];
            if (method_exists($this->controlHome, $method)) {
                $this->controlHome->$method();
            } else {
                $this->controlError->show500();
            }
        }
    }
}
