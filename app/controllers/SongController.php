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

    public function getListSongs($params)
    {
        $limit = isset($params[0]) && is_numeric($params[0]) ? intval($params[0]) : 5;

        if ($limit < 1) {
            ErrorView::show404();
            return;
        }

        $totalSongs = $this->songModel->getSongsCount();

        if ($limit > $totalSongs) {
            $limit = $totalSongs;
        }

        $songs = $this->songModel->getSongsLimit($limit);

        if (!empty($songs)) {
            $this->songView->showSongsList($songs, $limit, $totalSongs);
        } else {
            ErrorView::showMaintenance();
        }
    }

    public function getSongDetails($params)
    {
        if (empty($params[0]) || !is_numeric($params[0])) {
            ErrorView::show404();
            return;
        }

        $idSong = intval($params[0]);
        $song = $this->songModel->getSongById($idSong);

        if ($song) {
            $this->songView->showSongDetails([$song]);
        } else {
            ErrorView::showMaintenance();
        }
    }





    public function showSongs()
    {
        $songs = $this->songModel->getSongs();
        $this->songView->showSongs($songs);
    }

    public function showSongById()
    {

        $id_song = $_POST['id_song'] ?? null;

        if (empty($id_song)) {
            ErrorView::showError();
            return;
        }

        if ($id_song) {
            $song = $this->songModel->getSongs($id_song);
            if (!$song) {
                echo "La canción no existe.";
                return;
            }
            $this->songView->showSong($song);
        }
    }

    /**
     *         ABM
     *         -> VERIFICAMOS LA SESSION DE C/U (ACTUALMENTE COMENTADOS)
     *         -> INSERTAMOS VARIABLES P/ CARGAR (en caso de que sea necesario)
     *         -> ENVIAMOS LOS DATOS AL MODEL, LLAMAMOS AL MÉTODO CORRESPONDIENTE
     *         -> DESPUÉS DE EJECUTAR LA ACCIÓN, REDIRIGIMOS AL LISTADO (/songs)
     */

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
    // public function showFormEditSong($id)
    // {
    //     $song = $this->songModel->getSongs($id);
    //     $artists = $this->artistModel->getArtists();
    //     $this->songView->showFormEditSong($song, $artists);
    // }

    public function editSong($id)
    {
        $id_artist = $_POST['id_artist'] ?? null;
        $title = $_POST['title'] ?? null;
        $album = $_POST['album'] ?? null;
        $duration = $_POST['duration'] ?? null;
        $genre = $_POST['genre'] ?? null;
        $video = $_POST['video'] ?? null;

        if (!$title || !$album || !$duration || !$genre || !$video) {
            ErrorView::showError();
            return;
        }

        $result = $this->songModel->addSong(
            $id,
            $id_artist,
            $title,
            $album,
            $duration,
            $genre,
            $video
        );

        if ($result) {

            $song = (object)[
                'id_song'      => '-',
                'id_artist' => $id_artist,
                'title'           => $title,
                'album'      => $album,
                'duration'          => $duration,
                'genre'  => $genre,
                'video'  => $video
            ];

            $this->songView->showSuccess($song);
        } else {
            ErrorView::showError();
        }
    }


    public function removeSong($id)
    {
        // AuthHelper::verify();
        $this->songModel->removeSong($id);
        //header('Location: ' . BASE_URL . 'songs');
        exit;
    }
}
