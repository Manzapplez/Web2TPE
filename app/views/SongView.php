<?php

class SongView extends View
{

    public function showSong($songs)
    {
        require 'templates/songList.phtml';
    }

    public function show($song)
    {
        require 'templates/songDetail.phtml';
    }

    // functions de add y edit songs

}
