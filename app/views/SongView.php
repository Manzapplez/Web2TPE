<?php

require_once 'View.php';

class SongView extends View
{

    public function showSongs($songs)
    {
        require './app/templates/songList.phtml';
    }

    public function showSong($song)
    {
        require './app/templates/songDetail.phtml';
    }

    public function showFormAddSong($artists)
    {
        require './app/templates/formAddSong.phtml';
    }

    public function showFormEditSong($song, $artists)
    {
        require './app/templates/formEditSong.phtml';
    }
}
