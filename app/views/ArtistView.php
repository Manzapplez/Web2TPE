<?php

class ArtistView
{
    public function showArtistCount(int $count): void
    {
        $user = $_SESSION['user'] ?? null;
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/messages/artistCount.phtml';
        require_once './app/templates/admin/sectionArtist.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    public function showArtists($artists): void
    {
        $user = $_SESSION['user'] ?? null;

        if ($artists && !is_array($artists)) {
            $artists = [$artists];
        }

        require_once './app/templates/home/header.phtml';
        require './app/templates/admin/tableArtists.phtml';
        require_once './app/templates/admin/sectionArtist.phtml';
        require_once './app/templates/home/footer.phtml';
    }



    public function showArtistAlreadyExists(string $name): void
    {
        //      $this->viewAdmin->showArtistAlreadyExists($name);
    }

    public function showArtistNotFound(string $name): void
    {
        $user = $_SESSION['user'] ?? null;
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/messages/artistNotFound.phtml';
        require_once './app/templates/admin/sectionArtist.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    public function showSuccess($artists): void
    {
        $user = $_SESSION['user'] ?? null;
        if ($artists && !is_array($artists)) {
            $artists = [$artists];
        }
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/messages/operationSuccessful.phtml';
        require './app/templates/admin/tableArtists.phtml';
        require_once './app/templates/admin/sectionArtist.phtml';
        require_once './app/templates/home/footer.phtml';
    }
}
