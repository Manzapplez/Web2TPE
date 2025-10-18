<?php
require_once __DIR__ . '/../../views/viewAdmin/ViewAdmin.php';
require_once __DIR__ . '/../admin/ControlArtist.php';
require_once __DIR__ . '/../helpers/AuthHelper.php';

class ControlAdmin
{
    private ViewAdmin $viewAdmin;
    private AuthHelper $authHelper;
    private ControlArtist $artistControl;

    public function __construct()
    {
        $this->artistControl = new ControlArtist();
        $this->viewAdmin = new ViewAdmin();
        $this->authHelper = new AuthHelper();
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

    public function showArtist(object $artist): void
    {
        //        $this->viewAdmin->showArtist($artist);
    }

    public function showArtistAlreadyExists(string $name): void
    {
        //      $this->viewAdmin->showArtistAlreadyExists($name);
    }

    public function showArtistNotFound(string $name): void
    {
        //    $this->viewAdmin->showArtistNotFound($name);
    }

    public function showAdmin(): void
    {
        echo "entre";
        $this->viewAdmin->showAdmin();
        /*
        if ($this->authHelper->isLoggedIn()) {
            $this->viewAdmin->showAdmin();
            return;
        }
        header('Location: /soundSnack/public/login');
        exit;
        falla*/
    }
}
