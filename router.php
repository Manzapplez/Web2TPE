<?php
require_once 'app/controllers/task.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'reviews'; 
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}


/*TABLA DE RUTEO
ACCION                         URL                      DESTINO
Mostrar todas las reseñas      /reviews                 review.controller->showReviews()
Mostrar reseña                 /reviews/ID              review.controller->showReview($id)

Cargar reseña
Modificar reseña
Eliminar reseña

Mostrar todas las pelis        /movies                  movie.controller->showMovies()
Mostrar peli                   /movies/ID               movie.controller->showMovie($id)

Cargar peli                    /movie_add
Modificar peli
Eliminar peli

Loguear                        /login                   auth.controller->login()
Autenticacion                  /auth                    auth.controller->auth()
Desloguear                     /logout                  auth.controller->logout()
*/


$params = explode('/', $action);

switch($params[0]){
    case 'reviews':
        $controller= new ReviewController();
        if(isset($params[1])){
            $controller->showReview($params[1]);
            break;
        }
        $controller->showReviews();
        break;
    case 'movies':
        $controller= new MovieController();
        if(isset($params[1])){
            $controller->showMovie($params[1]);
            break;
        }
        $controller->showMovies();
        break;
    case 'login'
        $controller = new AuthController();
        $controller->login();
        break;
    case 'auth'
        $controller = new AuthController();
        $controller->auth();
    break;
    case 'logout'
        $controller = new AuthController();
        $controller->logout();
    break;
}