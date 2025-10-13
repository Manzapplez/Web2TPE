<?php

require_once 'View.php';

class SongView extends View
{

    public function showSongs($songs)
    {
                $form= './app/templates/formAddSong.phtml';
        require './app/templates/songList.phtml';
    }

    public function showSong($song)
    {
        require './app/templates/songDetail.phtml';
    }

    // revisar
    public function editSongForm($song, $songs, $artist){
        $form = './app/templates/formEditSong.phtml';
        require './app/templates/songList.phtml';
    }

}
