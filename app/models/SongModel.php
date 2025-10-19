<?php

require_once './app/database/dbConfig/DBConnection.php';

class SongModel {
    public function getSongs () {}
    public function addSong () {

    }
    public function removeSong () {

    }

    public function editSong () {}
 }

/* php no sabe dónde está model al declarar las clases hijas porque no carga automáticamente todos los archivos 
a menos que le haga un require/include o tenga un autoloader en config.php, por ahora lo pongo como require */

/* Maneja la comunicacion con la BBDD de canciones. CONTIENE CRUD, PHP + PDO. */
/*
class SongModel extends Model
{
    public function getSongs($id = null)
    {
        if ($id) {
            // UNA sola canción, songs/id
            $query = $this->db->prepare('
            SELECT songs.*, artists.name
            FROM songs
            JOIN artists ON songs.id_artist = artists.id_artist
            WHERE songs.id_song = ?
        ');
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_OBJ);
        } else {
            // TODAS las canciones, songs/
            $query = $this->db->prepare('
            SELECT songs.*, artists.name
            FROM songs
            JOIN artists ON songs.id_artist = artists.id_artist
            ORDER BY songs.id_artist
        ');
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }
    }

    // ABM
    public function addSong($id_artist, $title, $album, $duration, $genre, $video)
    {
        $query = $this->db->prepare('INSERT INTO songs (id_artist, title, album, duration, genre, video) VALUES (?,?,?,?,?,?)');
        $query->execute([$id_artist, $title, $album, $duration, $genre, $video]);
    }

    public function editSong($id, $id_artist, $title, $album, $duration, $genre, $video)
    {
        $query = $this->db->prepare('UPDATE songs SET id_artist = ?, title = ?, album = ?, duration = ?, genre = ?, video = ? WHERE id_song = ?');
        $query->execute([$id_artist, $title, $album, $duration, $genre, $video, $id]);
    }


    public function removeSong($id)
    {
        $query = $this->db->prepare('DELETE FROM songs WHERE id_song=?');
        $query->execute([$id]);
    }
}
*/