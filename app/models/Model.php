<?php

require_once 'config.php';

class Model
{
    public $db; // TEMPORALMENTE PUBLIC PARA USAR test_deploy.php en terminal
    // VOLVER A PROTECTED

    public function __construct()
    {
        $this->db = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
            DB_USER,
            DB_PASSWORD
        );
        $this->_deploy();
    }

    private function _deploy() // tablas del archivo exportado de phpMyAdmin
    {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();


        if (count($tables) == 0) {

/* Si quisieramos, en vez de pegar todo esto de la tabla,
podríamos poner la ruta del archivo SQL.
$sqlFile = 'directorio/sound_snack.sql';
Verificamos si existe (if(!file_exists($sqlFile)) tiramos error)
$sql = file_get_contents($sqlFile);
*/
            $sql = <<<END
CREATE TABLE `artists` (
  `id_artist` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `biography` text DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_artist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `artists` (`id_artist`, `name`, `biography`, `cover`) VALUES
(1, 'Miranda!', 'Miranda! es un dúo argentino de pop formado en 2001 integrado por Ale Sergi y Juliana Gattas.', ''),
(2, 'Bad Bunny', 'Bad Bunny nació en San Juan, Puerto Rico, el 10 de marzo de 1994. Es compositor y cantante de música urbana, sobre todo trap y reggaetón.', ''),
(3, 'Lady Gaga', 'Stefani Joanne Angelina Germanotta, conocida por su nombre artístico Lady Gaga, es una cantante, compositora, productora, bailarina, actriz, activista y diseñadora de moda estadounidense.​', '');

CREATE TABLE `songs` (
  `id_song` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_artist` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `album` varchar(100) NOT NULL,
  `duration` decimal(4,2) DEFAULT NULL,
  `genre` varchar(50) NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_song`),
  KEY `id_artist` (`id_artist`),
  CONSTRAINT `Songs_ibfk_1` FOREIGN KEY (`id_artist`) REFERENCES `artists` (`id_artist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `songs` (`id_song`, `id_artist`, `name`, `album`, `duration`, `genre`, `video`) VALUES
(1, 1, 'Don', 'El Disco de tu Corazón', 3.50, 'Pop', 'https://youtu.be/8-E2ufHz7Bs'),
(2, 1, 'Perfecta', 'El Disco de tu Corazón', 3.40, 'Pop', 'https://youtu.be/7ShXEEn3AlE'),
(3, 1, 'Yo te diré', 'Sin Restricciones', 3.30, 'Pop', 'https://youtu.be/n-dWF20u2RU'),
(4, 2, 'Dakiti', 'El Último Tour del Mundo', 3.25, 'Reggaetón', 'https://youtu.be/TmKh7lAwnBI'),
(5, 2, 'Tití Me Preguntó', 'Un Verano Sin Ti', 4.00, 'Reggaetón', 'https://youtu.be/hs6alRuYcBo'),
(6, 2, 'Callaíta', 'YHLQMDLG', 4.10, 'Reggaetón', 'https://youtu.be/ZrJ8jHcvBrY'),
(7, 3, 'Poker Face', 'The Fame', 3.58, 'Pop', 'https://youtu.be/bESGLojNYSo'),
(8, 3, 'Bad Romance', 'The Fame Monster', 4.54, 'Pop', 'https://youtu.be/qrO4YZeyl0I'),
(9, 3, 'Abracadabra', 'Mayhem', 3.43, 'Electropop', 'https://www.youtube.com/watch?v=vBynw9Isr28');

CREATE TABLE `users` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'webadmin', 'admin');
END;
            $this->db->exec($sql);
            // en vez de $this->db->query($sql) usamos exec porque contiene multiples sentencias
        }
    }
}
