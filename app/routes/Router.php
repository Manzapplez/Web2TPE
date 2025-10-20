<?php
require_once './app/controllers/UserController.php';
require_once './app/controllers/ArtistController.php';
require_once './app/controllers/SongController.php';
require_once './app/views/ErrorView.php';

class Router
{
    private UserController $userController;
    private AuthController $authController;
    private ArtistController $artistController;
    private SongController $songController;

    private string $action;
    private static string $baseUrl;

    //Array asociativo multidimensional para almacenar todas las actions disponibles para el usuario
    private const ACTIONS = [
        'home'          => ['controller' => 'userController',   'method' => 'showHome'],
        'login'         => ['controller' => 'userController',   'method' => 'showLogin'],
        'register'      => ['controller' => 'userController',   'method' => 'showRegister'],
        'registerUser'  => ['controller' => 'userController',   'method' => 'registerUser'],
        'admin'         => ['controller' => 'userController', 'method' => 'showAdmin'],

        'logIn'         => ['controller' => 'authController',   'method' => 'logInUser'],
        'logOut'        => ['controller' => 'authController',   'method' => 'logOut'],

        'addArtist'     => ['controller' => 'artistController', 'method' => 'insertArtist'],
        'updateArtist'  => ['controller' => 'artistController', 'method' => 'updateArtist'],
        'deleteArtist'  => ['controller' => 'artistController', 'method' => 'deleteArtistByName'],
        'viewArtistById' => ['controller' => 'artistController', 'method' => 'getArtistById'],
        'viewArtistByName'   => ['controller' => 'artistController', 'method' => 'getArtistByName'],
        'viewArtists'   => ['controller' => 'artistController', 'method' => 'getArtistsLimit'],

        'songs'         => ['controller' => 'songController',   'method' => 'showSongs'],
        'song'          => ['controller' => 'songController',   'method' => 'showSongById'],
        'addSong'       => ['controller' => 'songController',   'method' => 'addSong'],
        'editSong'      => ['controller' => 'songController',   'method' => 'editSong'],
        'removeSong'    => ['controller' => 'songController',   'method' => 'removeSong']
    ];

    public function __construct()
    {
        $this->userController   = new UserController();
        $this->authController = new AuthController();
        $this->artistController = new ArtistController();
        $this->songController   = new SongController();

        self::defineBaseUrl();
        $this->defineAction();
    }

    // Determina la URL base de la aplicación
    private static function defineBaseUrl(): void
    {
        self::$baseUrl = '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT']
            . dirname($_SERVER['PHP_SELF']) . '/';
    }

    public static function getBaseUrl(): string
    {
        return self::$baseUrl;
    }

    // Determina la acción solicitada por el usuario
    private function defineAction(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $base = dirname($_SERVER['PHP_SELF']);
        $path = trim(substr($uri, strlen($base)), '/');
        $this->action = $path ?: 'home';
    }

    // Evalúa la acción solcitada y llama al método correspondiente de forma dinamica
    public function evaluateAction(): void
    {
        $route = explode("/", $this->action)[0];

        if (!isset(self::ACTIONS[$route])) {
            ErrorView::show404();
            return;
        }

        $controllerName = self::ACTIONS[$route]['controller'];
        $method         = self::ACTIONS[$route]['method'];

        $controller = $this->$controllerName;

        if (method_exists($controller, $method)) {
            $controller->$method();
        } else {
            ErrorView::show500();
        }
    }
}
