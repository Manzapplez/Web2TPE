<?php

/* Maneja la comunicacion con la BBDD de canciones.
CONTIENE CRUD, PHP + PDO. */

class SongModel extends Model
{
    // get songs de la db
    public function getSongs() {}

    // ABM
    public function addSong() {}

    public function editSong() {}

    public function removeSong($id)
    {
        $query = $this->db->prepare('DELETE FROM songs WHERE id_song=?');
        $query->execute([$id]);
    }
}