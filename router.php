<?php

require_once './app/controllers/SongController.php';
// require_once './app/controllers/ArtistController.php';
require_once './app/controllers/AuthController.php';

$action = 'songs';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

/* TABLA DE RUTEO

ACCION					        URL		            DESTINO

Mostrar todas las canciones 	/songs		        SongController->showSongs()
Mostrar canción				    /songs/id	        SongController->showSongs(id)
Cargar canción				    /addSong	        SongController->addSong()
Modificar cancion			    /editSong/id	    SongController->editSong($id)
Eliminar cancion			    /removeSong/id	    SongController->removeSong($id)

Artistas

Loguear                        /login               AuthController->login()
Autenticacion                  /auth                AuthController->auth()
Desloguear                     /logout              AuthController->logout()

*/

$params = explode('/', $action);

switch ($params[0]) {

    // utilizamos songs tanto para el listado como para el detalle, depende de si viene con params :3
    case 'songs':
        $controller = new SongController();
        $controller->showSongs($params[1] ?? null);
        break;

    case 'addSong':
        $controller = new SongController();
        $controller->addSong();
        break;

    case 'editSong':
        $controller = new SongController();
        $controller->editSong($params[1]);
        break;

    case 'removeSong':
        $controller = new SongController();
        $controller->removeSong($params[1]);
        break;

    // Artist CRUD cases

    // LOGIN, LOGOUT, AUTH.
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;

    default:
        echo "asdafq3twedfsdfsdsssa";
        break;
}
