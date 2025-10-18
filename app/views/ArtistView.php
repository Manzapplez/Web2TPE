<?php


class ArtistView
{


    public function __construct()
    {
        //     $this->artistController = new ArtistController();

        //   $this->authHelper = new AuthHelper();
    }

    public function showArtistId(int $id): void
    {
        // $this->viewAdmin->showArtistId($id);
    }

    public function showArtistCount(int $count): void
    {
        // $this->viewAdmin->showArtistCount($count);
    }

    public function showAllArtists(array $artists): void
    {
        //   $this->viewAdmin->showAllArtists($artists);
    }

    public function showArtistAlreadyExists(string $name): void
    {
        //      $this->viewAdmin->showArtistAlreadyExists($name);
    }

    public function showArtistNotFound(string $name): void
    {
        //    $this->viewAdmin->showArtistNotFound($name);
    }

    public function showArtist(): void
    {
        require_once './app/templates/home/header.phtml';
        //  require_once './app/templates/admin/nav.phtml'; podria ser para navegar mas rapido ir directamente a la seccion de artistas o de usuarios o de canciones, mas practico
        require_once './app/templates/admin/artAdmin.phtml'; //podria ser parte del section artist
        require_once './app/templates/admin/sectionArtist.phtml';
        require_once './app/templates/home/footer.phtml';
    }
}
