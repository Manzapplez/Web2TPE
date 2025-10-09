<?php

require_once './app/config.php';
require_once '/app/controllers/SongController.php';
require_once ''; // artist controller
require_once ''; // auth?

/* TABLA DE RUTEO

ACCION					        URL		        DESTINO

Mostrar todas las canciones 	/songs		    SongController->showSongs()
Mostrar canción				    /songs/id	    SongController->showSongs(id)
Cargar canción				    /addSong	    SongController->add()
Modificar cancion			    /editSong/id	SongController->edit($id)
Eliminar cancion			    /removeSong/id	SongController->remove($id)

Mostrar todos
Mostrar uno
Cargar
Modificar
Eliminar

Loguear
Autenticar
Desloguear

*/