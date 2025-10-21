<?php

require_once 'View.php';

class SongView extends View
{

    public function showSongs($songs)
    {
        $user = $_SESSION['user'] ?? null;

        if ($songs && !is_array($songs)) {
            $songs = [$songs];
        }

        require './app/templates/home/header.phtml';
        require './app/templates/songList.phtml';
        require_once './app/templates/admin/sectionSong.phtml';
        require './app/templates/home/footer.phtml';
    }

    public function showSong($song)
    {
        require './app/templates/songDetail.phtml';
    }

    // public function showFormAddSong($artists)
    // {
    //     require './app/templates/formAddSong.phtml';
    // }

    // public function showFormEditSong($song, $artists)
    // {
    //     require './app/templates/formEditSong.phtml';
    // }


    public function showSongsList($songs, int $limit, int $totalSongs): void
    {
        $user = $_SESSION['user'] ?? null;

        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/home/songList.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    public function showSongDetails(array $songs): void
    {
        $user = $_SESSION['user'] ?? null;

        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/home/songDetail.phtml';
        require_once './app/templates/home/footer.phtml';
    }
}
