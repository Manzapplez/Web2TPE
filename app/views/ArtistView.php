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

    public function showArtist()
    {

        echo "operacion exitosa";
    }
}
