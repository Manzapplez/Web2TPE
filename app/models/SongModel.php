<?php

require_once './app/database/dbConfig/DBConnection.php';

class SongModel
{
    private ?PDO $db;

    public function __construct()
    {
        $connection = DBConnection::getInstance();
        $this->db = $connection->getPDO();
    }



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



    // Retorna la cantidad n. de canciones disponibles 
    public function getSongsCount(): int
    {
        $sql = "SELECT COUNT(*) AS total FROM songs";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            return $row ? (int)$row->total : 0;
        } catch (PDOException $e) {
            error_log("Error al obtener la cantidad de canciones: " . $e->getMessage());
            return 0;
        }
    }

    // Obtiene una cantidad limitada de canciones junto con el nombre del artista.
    public function getSongsLimit(int $limit): array
    {
        $songsList = [];
        $limit = max(1, $limit);

        $sql = "SELECT s.id_song, s.id_artist, s.title, s.album, s.duration, s.genre, s.video, a.name AS artist_name
            FROM songs s
            JOIN artists a ON s.id_artist = a.id_artist
            LIMIT $limit";

        try {
            $stmt = $this->db->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $songsList[] = $row;
            }
        } catch (PDOException $e) {
            error_log("Error al obtener las canciones con límite: " . $e->getMessage());
            return [];
        }

        return $songsList;
    }

    // Obtiene todas las canciones de un artista específico.
    public function getSongsByArtist(int $idArtist): array
    {
        $songsList = [];

        $sql = "SELECT id_song, title, album, duration, genre, video 
            FROM songs 
            WHERE id_artist = :id_artist";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_artist', $idArtist, PDO::PARAM_INT);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $songsList[] = $row;
            }
        } catch (PDOException $e) {
            error_log("Error al obtener canciones del artista: " . $e->getMessage());
            return [];
        }

        return $songsList;
    }

    // Obtiene la canción por ID
    public function getSongById(int $id): ?object
    {
        $sql = "SELECT s.id_song, s.id_artist, s.title, s.album, s.duration, s.genre, s.video,
                   a.name AS artist_name
            FROM songs s
            JOIN artists a ON s.id_artist = a.id_artist
            WHERE s.id_song = ?";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            return $row ?: null;
        } catch (PDOException $e) {
            error_log("Error al buscar canción con ID '$id': " . $e->getMessage());
            return null;
        }
    }
}
