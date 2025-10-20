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

    public function showArtistAlreadyExists(): void
    {
        $user = $_SESSION['user'] ?? null;

        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/messages/artistAlreadyExists.phtml';
        require_once './app/templates/home/footer.phtml';
    }

    public function showArtistsList($artists, int $limit, int $totalArtists): void
    {
        $user = $_SESSION['user'] ?? null;

        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/admin/listArtist.phtml';
        require_once './app/templates/home/footer.phtml';
    }


    public function showArtistDetail($songs): void
    {
        $user = $_SESSION['user'] ?? null;
        /*
        if (!$artist || !is_object($artist)) {
            ErrorView::showError();
            return;
        }*/
        echo "entre";
        /*
        require_once './app/templates/home/header.phtml';
        require_once './app/templates/home/nav.phtml';
        require_once './app/templates/admin/tableArtists.phtml';
        require_once './app/templates/home/footer.phtml';*/
    }
}
