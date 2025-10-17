<?php

require_once __DIR__ . '/../../models/admin/Artist.php';
require_once __DIR__ . '/../../views/viewAdmin/ViewAdmin.php';

class ControlArtist
{
    private Artist $artistModel;
    private ViewAdmin $viewAdmin;

    public function __construct()
    {
        $this->artistModel = new Artist();
        $this->viewAdmin = new ViewAdmin();
    }

    public function getArtistIdByName(): void
    {
        $name = $_POST['name'] ?? null;

        if (empty($name)) {
            $this->viewAdmin->showError();
            return;
        }

        if ($this->artistModel->artistExists($name)) {
            $result = $this->artistModel->getArtistIdByName($name);
            $result !== null ? $this->viewAdmin->showArtistId($result) : $this->viewAdmin->showError();
        } else {
            $this->viewAdmin->showArtistNotFound($name);
        }
    }

    public function getArtistsCount(): void
    {
        $result = $this->artistModel->getArtistsCount();
        $result !== 0 ? $this->viewAdmin->showArtistCount($result) : $this->viewAdmin->showError();
    }

    public function getArtistsLimit(): void
    {
        $limit = $_POST['limit'] ?? null;

        if (empty($limit) || !is_numeric($limit) || (int)$limit <= 0) {
            $this->viewAdmin->showError();
            return;
        }

        $limit = (int)$limit;
        $totalArtists = $this->artistModel->getArtistsCount();

        if ($totalArtists === 0) {
            $this->viewAdmin->showError();
            return;
        }

        if ($limit > $totalArtists) {
            $limit = $totalArtists;
        }

        $artists = $this->artistModel->getArtistsLimit($limit);
        !empty($artists) ? $this->viewAdmin->showAllArtists($artists) : $this->viewAdmin->showError();
    }

    public function getArtistByName(): void
    {
        $name = $_POST['name'] ?? null;

        if (empty($name)) {
            $this->viewAdmin->showError();
            return;
        }

        if ($this->artistModel->artistExists($name)) {
            $result = $this->artistModel->getArtistByName($name);
            $result !== null ? $this->viewAdmin->showArtist($result) : $this->viewAdmin->showError();
        } else {
            $this->viewAdmin->showArtistNotFound($name);
        }
    }

    public function insertArtist(): void
    {
        $name           = $_POST['name'] ?? '';
        $biography      = $_POST['biography'] ?? '';
        $cover          = $_FILES['cover'] ?? null;
        $date_of_birth  = $_POST['date_of_birth'] ?? '';
        $date_of_death  = $_POST['date_of_death'] ?? null;
        $place_of_birth = $_POST['place_of_birth'] ?? '';

        if (!$name || !$biography || !$cover || !$date_of_birth || !$place_of_birth) {
            $this->viewAdmin->showError();
            return;
        }

        if ($this->artistModel->artistExists($name)) {
            $this->viewAdmin->showArtistAlreadyExists($name);
            return;
        }

        $coverPath = $this->handleCoverUpload($cover, $name);
        if ($coverPath === null) {
            $this->viewAdmin->showError();
            return;
        }

        $result = $this->artistModel->insertArtist(
            $name,
            $biography,
            $coverPath,
            $date_of_birth,
            $date_of_death,
            $place_of_birth
        );

        $result ? $this->viewAdmin->showSuccess() : $this->viewAdmin->showError();
    }

    public function deleteArtistByName(): void
    {
        $name = $_POST['name'] ?? null;

        if (empty($name)) {
            $this->viewAdmin->showError();
            return;
        }

        if ($this->artistModel->artistExists($name)) {
            $result = $this->artistModel->deleteArtistByName($name);
            $result ? $this->viewAdmin->showSuccess() : $this->viewAdmin->showError();
        } else {
            $this->viewAdmin->showArtistNotFound($name);
        }
    }

    public function updateArtist(): void
    {
        $name            = $_POST['name'] ?? null;
        $newBiography    = $_POST['biography'] ?? null;
        $newCover        = $_FILES['cover'] ?? null;
        $newDateOfBirth  = $_POST['date_of_birth'] ?? null;
        $newDateOfDeath  = $_POST['date_of_death'] ?? null;
        $newPlaceOfBirth = $_POST['place_of_birth'] ?? null;

        if (empty($name)) {
            $this->viewAdmin->showError();
            return;
        }

        if (!$this->artistModel->artistExists($name)) {
            $this->viewAdmin->showArtistNotFound($name);
            return;
        }

        $artistId = $this->artistModel->getArtistIdByName($name);
        if ($artistId === null) {
            $this->viewAdmin->showError();
            return;
        }

        $updated = false;

        if (!empty($newBiography)) {
            $updated = $this->artistModel->updateArtistBiography($artistId, $newBiography) || $updated;
        }

        $hasCover = $newCover && isset($newCover['name']) && $newCover['error'] === UPLOAD_ERR_OK;
        if ($hasCover) {
            $coverPath = $this->handleCoverUpload($newCover, $name);
            if ($coverPath !== null) {
                $updated = $this->artistModel->updateArtistCover($artistId, $coverPath) || $updated;
            }
        }

        if (!empty($newDateOfBirth)) {
            $updated = $this->artistModel->updateArtistDateOfBirth($artistId, $newDateOfBirth) || $updated;
        }

        if (!empty($newDateOfDeath)) {
            $updated = $this->artistModel->updateArtistDateOfDeath($artistId, $newDateOfDeath) || $updated;
        }

        if (!empty($newPlaceOfBirth)) {
            $updated = $this->artistModel->updateArtistPlaceOfBirth($artistId, $newPlaceOfBirth) || $updated;
        }

        $updated ? $this->viewAdmin->showSuccess() : $this->viewAdmin->showError();
    }

    private function handleCoverUpload(array $file, string $artistName): ?string
    {
        $uploadDir = __DIR__ . '/../../artist_images/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $safeName  = preg_replace("/[^a-zA-Z0-9_\-]/", "_", strtolower($artistName));
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename  = $safeName . '.' . $extension;
        $destination = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return 'artist_images/' . $filename;
        }

        return null;
    }
}
