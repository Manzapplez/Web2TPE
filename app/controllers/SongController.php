<?php

require_once './app/models/SongModel.php';
// require_once './app/models/ArtistModel.php';
// require_once './app/views/';

/*

Song Controller

Intermediario entre view y model, controla el flujo de la aplicación,
procesa las solicitudes y valida la entrada de datos del usuario.
Pide al model la info y se la lleva a la view para que muestre.

    songs/
    + Listado de ítems (lista con todas las canciones) 

    song/:id
    + Detalle de ítem (al clickear la canción lleva a más datos)

*/

class SongController
{
    private $songModel;
    private $songView;
    // private $artistModel;

    public function __construct()
    {
        $this->songModel = new SongModel();
        // $this->songView = new SongView();
        // $this->artistModel = new artistModel();
    }

    /*
    public function showSongs() {
        $songs= $this->songModel->getAll();
        $this->songView->show($songs);
    }
        */
}
