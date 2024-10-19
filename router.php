<?php
require_once './app/config/config.php';
require_once './app/controllers/movie.controller.php';
require_once './app/controllers/review.controller.php';
require_once './app/controllers/auth.controller.php';

$action = 'reviews';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}


/*TABLA DE RUTEO
ACCION                         URL                      DESTINO
Mostrar todas las reseñas      /reviews                 review.controller->showReviews()
Mostrar reseña                 /reviews/id              review.controller->showReview($id)
Cargar reseña                  /addReview               review.controller->add()
Modificar reseña               /editReview/id           review.controller->edit($id)
Eliminar reseña                /removeReview/id         review.controller->remove($id)

Mostrar todas las pelis        /movies                  movie.controller->showMovies()
Mostrar peli                   /movies/id               movie.controller->showMovie($id)
Cargar peli                    /addMovie                movie.controller->add()
Modificar peli                 /editMovie/id            movie.controller->edit($id)
Eliminar peli                  /removeMovie/id          movie.controller->remove($id)

Loguear                        /login                   auth.controller->login()
Autenticacion                  /auth                    auth.controller->auth()
Desloguear                     /logout                  auth.controller->logout()
*/


$params = explode('/', $action);

switch ($params[0]) {
    case 'reviews':
        $controller = new ReviewController();
        if (isset($params[1])) {
            $controller->showReview($params[1]);
            break;
        }
        $controller->showReviews();
        break;
    case 'addReview':
        $controller = new ReviewController();
        $controller->addReview();
        break;
    case 'editReview':
        $controller = new ReviewController();
        $controller->editReview($params[1]);
        break;
    case 'removeReview':
        $controller = new ReviewController();
        $controller->removeReview($params[1]);
        break;

    case 'movies':
        $controller = new MovieController();
        if (isset($params[1])) {
            $controller->showMovie($params[1]);
            break;
        }
        $controller->showMovies();
        break;
    case 'addMovie':
        $controller = new MovieController();
        $controller->addMovie();
        break;
    case 'editMovie':
        $controller = new MovieController();
        $controller->editMovie($params[1]);
        break;
    case 'removeMovie':
        $controller = new MovieController();
        $controller->removeMovie($params[1]);
        break;

    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
}
