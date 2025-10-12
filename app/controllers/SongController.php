<?php

require_once './app/models/SongModel.php';
// require_once './app/models/ArtistModel.php';

/* Intermediario entre SongView y SongModel, controla el flujo de la aplicación,
procesa las solicitudes y valida la entrada de datos del usuario.
Pide al model la info y se la lleva a la view para que muestre. */

class SongController
{
    private $songModel;
    private $songView;
    // private $artistModel;

    public function __construct()
    {
        $this->songModel = new SongModel();
        $this->songView = new SongView();
        // $this->artistModel = new ArtistModel();

        /* Al hacer el ADD de SONGS se debe poder seleccionar el ARTISTA a la que pertenecen
        utilizando <select> que muestra listado de Artistas. */
    }

    // utilizamos songs tanto para el listado como para el detalle, depende de si viene con params :3
    public function showSongs($id = null)
    {
        if ($id) {
            $song = $this->songModel->getSongs($id);
            $this->songView->showSong($song);
        } else {
            $songs = $this->songModel->getSongs();
            $this->songView->show($songs);
        }
    }

    /**
     * 
     *         ACCIONES ABM
     *         -> VERIFICAMOS LA SESSION DE C/U
     *         -> INSERTAMOS VARIABLES P/ CARGAR (en caso de que sea necesario)
     *         -> ENVIAMOS LOS DATOS AL MODEL, LLAMAMOS AL MÉTODO CORRESPONDIENTE
     *         -> DESPUÉS DE EJECUTAR LA ACCIÓN, REDIRIGIMOS AL LISTADO (/songs)
     * 
     */

    public function addSong()
    {
        AuthHelper::verify();
        /*
            $nombreVariable = $_POST['nombreVariable'];
            $nombreVariable = $_POST['nombreVariable'];
            $nombreVariable = $_POST['nombreVariable'];

            $this->songModel->addSong($nombreVariable, $nombreVariable, etc.);
        */

        header('Location: ' . BASE_URL . 'songs');
    }

    public function editSong($id)
    {
        AuthHelper::verify();
        /*  
            $nombreVariable = $_POST['nombreVariable'];
            $nombreVariable = $_POST['nombreVariable'];
            $nombreVariable = $_POST['nombreVariable'];
            $nombreVariable = $_POST['nombreVariable'];

            $this->songModel->editSong($nombreVariable, $nombreVariable, etc.);
        */

        header('Location: ' . BASE_URL . 'songs');
    }

    public function removeSong($id)
    {
        AuthHelper::verify();
        $this->songModel->removeSong($id);
        header('Location: ' . BASE_URL . 'songs');
    }
}
