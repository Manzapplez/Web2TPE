<?php

require_once './app/models/ArtistModel.php';
require_once './app/views/ArtistView.php';

class ArtistController
{
    private ArtistModel $artistModel;
    private ArtistView $artistView;
    private const DEFAULT_COVER = "assets/img/covers/artist/default.jpg";
    private const COVER_UPLOAD_DIR = "assets/img/covers/artist/";

    public function __construct()
    {
        $this->artistModel = new ArtistModel();
        $this->artistView = new ArtistView();
    }

    public function getArtistIdByName()
    {
        $name = $_POST['name'] ?? null;

        if (empty($name)) {
            ErrorView::showError();
            return;
        }

        if ($this->artistModel->artistExists($name)) {
            $result = $this->artistModel->getArtistIdByName($name);
            $result !== null ? $this->artistView->showArtistId($result) : ErrorView::showError();
        } else {
            $this->artistView->showArtistNotFound($name);
        }
    }

    public function getArtistsCount()
    {
        $result = $this->artistModel->getArtistsCount();
        $result !== 0 ? $this->artistView->showArtistCount($result) : ErrorView::showError();
    }

    public function getArtistsLimit()
    {
        $limit = $_POST['limit'] ?? null;

        if (empty($limit) || !is_numeric($limit) || (int)$limit <= 0) {
            ErrorView::showError();
            return;
        }

        $limit = (int)$limit;
        $totalArtists = $this->artistModel->getArtistsCount();

        if ($totalArtists === 0) {
            ErrorView::showError();
            return;
        }

        if ($limit > $totalArtists) {
            $limit = $totalArtists;
        }

        $artists = $this->artistModel->getArtistsLimit($limit);
        !empty($artists) ? $this->artistView->showAllArtists($artists) : ErrorView::showError();
    }

    public function getArtistByName()
    {
        $name = $_POST['name'] ?? null;

        if (empty($name)) {
            ErrorView::showError();
            return;
        }

        if ($this->artistModel->artistExists($name)) {
            $result = $this->artistModel->getArtistByName($name);
            $result !== null ? $this->artistView->showArtist($result) : ErrorView::showError();
        } else {
            $this->artistView->showArtistNotFound($name);
        }
    }

    public function insertArtist()
    {
        $name           = $_POST['name'] ?? null;
        $biography      = $_POST['biography'] ?? null;
        $cover          = $_FILES['cover'] ?? null;
        $date_of_birth  = $_POST['date_of_birth'] ?? null;
        $date_of_death  = $_POST['date_of_death'] ?? null;
        $place_of_birth = $_POST['place_of_birth'] ?? null;

        if (!$name || !$biography || !$date_of_birth || !$place_of_birth) {
            ErrorView::showError();
            return;
        }

        if ($this->artistModel->artistExists($name)) {
            $this->artistView->showArtistAlreadyExists($name);
            return;
        }

        $hasCover = $cover && isset($cover['name']) && $cover['error'] === UPLOAD_ERR_OK;

        if ($hasCover) {
            $uploadedPath = FileUploader::handleCoverUpload($cover, $name, self::COVER_UPLOAD_DIR);
            if ($uploadedPath === null) {
                ErrorView::showPhotoUploadError();
                return;
            }
        }

        $result = $this->artistModel->insertArtist(
            $name,
            $biography,
            $hasCover ? $uploadedPath : self::DEFAULT_COVER,
            $date_of_birth,
            $date_of_death,
            $place_of_birth
        );

        $result ? ErrorView::showSuccess() : ErrorView::showError();
    }

    public function deleteArtistByName()
    {
        $name = $_POST['name'] ?? null;

        if (empty($name)) {
            ErrorView::showError();
            return;
        }

        if ($this->artistModel->artistExists($name)) {
            $result = $this->artistModel->deleteArtistByName($name);
            $result ? ErrorView::showSuccess() : ErrorView::showError();
        } else {
            $this->artistView->showArtistNotFound($name);
        }
    }

    public function updateArtist()
    {
        $name            = $_POST['name'] ?? null;
        $newBiography    = $_POST['biography'] ?? null;
        $newCover        = $_FILES['cover'] ?? null;
        $newDateOfBirth  = $_POST['date_of_birth'] ?? null;
        $newDateOfDeath  = $_POST['date_of_death'] ?? null;
        $newPlaceOfBirth = $_POST['place_of_birth'] ?? null;

        if (empty($name)) {
            ErrorView::showError();
            return;
        }

        if (!$this->artistModel->artistExists($name)) {
            $this->artistView->showArtistNotFound($name);
            return;
        }

        $artistId = $this->artistModel->getArtistIdByName($name);
        if ($artistId === null) {
            ErrorView::showError();
            return;
        }

        $updated = false;

        if (!empty($newBiography)) {
            $updated = $this->artistModel->updateArtistBiography($artistId, $newBiography) || $updated;
        }

        $hasCover = $newCover && isset($newCover['name']) && $newCover['error'] === UPLOAD_ERR_OK;

        $coverPath = $hasCover
            ? FileUploader::handleCoverUpload($newCover, $name, self::COVER_UPLOAD_DIR)
            : self::DEFAULT_COVER;

        if ($hasCover && $coverPath === null) {
            ErrorView::showCoverUploadError();
            return;
        }

        $updated = $this->artistModel->updateArtistCover($artistId, $coverPath) || $updated;

        if (!empty($newDateOfBirth)) {
            $updated = $this->artistModel->updateArtistDateOfBirth($artistId, $newDateOfBirth) || $updated;
        }

        if (!empty($newDateOfDeath)) {
            $updated = $this->artistModel->updateArtistDateOfDeath($artistId, $newDateOfDeath) || $updated;
        }

        if (!empty($newPlaceOfBirth)) {
            $updated = $this->artistModel->updateArtistPlaceOfBirth($artistId, $newPlaceOfBirth) || $updated;
        }

        $updated ? ErrorView::showSuccess() : ErrorView::showError();
    }
}
