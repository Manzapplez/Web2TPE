<?php

require_once './app/models/SongModel.php';
require_once './app/views/SongView.php';

/* Intermediario entre SongView y SongModel, controla el flujo de la aplicación,
procesa las solicitudes y valida la entrada de datos del usuario.
Pide al model la info y se la lleva a la view para que muestre. */

class SongController
{
    private $songModel;
    private $songView;
    private $artistModel;

    public function __construct()
    {
        $this->songModel = new SongModel();
        $this->songView = new SongView();
    }

    // utilizamos showSongs tanto para el listado como para el detalle, depende de si viene con params
    public function showSongs($id = null)
    {
        if ($id) {
            $song = $this->songModel->getSongs($id);
            if (!$song) {
                echo "La canción no existe.";
                return;
            }
            $this->songView->showSong($song);
        } else {
            $songs = $this->songModel->getSongs();
            $this->songView->showSongs($songs);
        }
    }

    /**
     *         ABM
     *         -> VERIFICAMOS LA SESSION DE C/U (ACTUALMENTE COMENTADOS)
     *         -> INSERTAMOS VARIABLES P/ CARGAR (en caso de que sea necesario)
     *         -> ENVIAMOS LOS DATOS AL MODEL, LLAMAMOS AL MÉTODO CORRESPONDIENTE
     *         -> DESPUÉS DE EJECUTAR LA ACCIÓN, REDIRIGIMOS AL LISTADO (/songs)
     */



    /* Si no agregamos el formulario de addSong en el phtml de songList entonces habría que agregar otro método que llame a eso,
    corroborar con Martín como le parece mejor que se vea la aplicación */
    public function addSong()
    {
        // AuthHelper::verify();

        $id_artist = $_POST['id_artist'];
        $title = $_POST['title'];
        $album = $_POST['album'];
        $duration = $_POST['duration'];
        $genre = $_POST['genre'];
        $video = $_POST['video'];

        $this->songModel->addSong($id_artist, $title, $album, $duration, $genre, $video);

        // header('Location: ' . BASE_URL . 'songs');
        exit;
    }


    // CARGA EL FORMULARIO
    public function showFormEditSong($id)
    {
        $song = $this->songModel->getSongs($id);
        $artists = $this->artistModel->getArtists();
        $this->songView->showFormEditSong($song, $artists);
    }

    public function editSong($id)
    {
        // AuthHelper::verify();
        $id_artist = $_POST['id_artist'];
        $title = $_POST['title'];
        $album = $_POST['album'];
        $duration = $_POST['duration'];
        $genre = $_POST['genre'];
        $video = $_POST['video'];

        $this->songModel->editSong($id, $id_artist, $title, $album, $duration, $genre, $video);

        //  header('Location: ' . BASE_URL . 'songs');
        exit;
    }

    public function removeSong($id)
    {
        // AuthHelper::verify();
        $this->songModel->removeSong($id);
        //header('Location: ' . BASE_URL . 'songs');
        exit;
    }
}
