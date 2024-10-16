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
Mostrar reseñas por genero     /reviews/?               review.controller->showReviews($genre)

Mostrar todas las pelis        /movies                  movie.controller->showMovies()
Mostrar peli                   /movies/ID               movie.controller->showMovie($id)
Mostrar pelis por genero       /movies/?                movie.controller->showMovies($genre)
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
}