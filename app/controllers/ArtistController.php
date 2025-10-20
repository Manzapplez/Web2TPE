<?php

require_once './app/models/ArtistModel.php';
require_once './app/views/ArtistView.php';

class ArtistController
{
    private ArtistModel $artistModel;
    private ArtistView $artistView;
    const DEFAULT_COVER = '/soundSnack/assets/img/covers/artists/default.jpg';
    private const COVER_UPLOAD_DIR = "assets/img/covers/artist/";

    public function __construct()
    {
        $this->artistModel = new ArtistModel();
        $this->artistView = new ArtistView();
    }

    public function getArtistById()
    {
        $id = $_POST['id_artist'] ?? null;
        if (empty($id) || !is_numeric($id) || (int)$id <= 0) {
            ErrorView::showError();
            return;
        }

        $id = (int)$id;
        $artist = $this->artistModel->getArtistById($id);

        if ($artist !== null) {
            $this->artistView->showArtists($artist);
        } else {
            $this->artistView->showArtistNotFound($id);
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
        !empty($artists) ? $this->artistView->showArtists($artists) : ErrorView::showError();
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
            $result !== null ? $this->artistView->showArtists($result) : ErrorView::showError();
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
                ErrorView::photoUploadError();
                return;
            }
        } else {
            $uploadedPath = self::DEFAULT_COVER;
        }

        $result = $this->artistModel->insertArtist(
            $name,
            $biography,
            $uploadedPath,
            $date_of_birth,
            $date_of_death,
            $place_of_birth
        );

        if ($result) {

            $artist = (object)[
                'id_artist'      => '-',
                'name'           => $name,
                'biography'      => $biography,
                'cover'          => $uploadedPath,
                'date_of_birth'  => $date_of_birth,
                'date_of_death'  => $date_of_death,
                'place_of_birth' => $place_of_birth
            ];
            $this->artistView->showSuccess($artist);
        } else {
            ErrorView::showError();
        }
    }

    public function deleteArtistByName()
    {
        $name = $_POST['name'] ?? null;

        if (empty($name)) {
            ErrorView::showError();
            return;
        }

        $artist = $this->artistModel->getArtistByName($name);

        if ($artist !== null) {
            $result = $this->artistModel->deleteArtistByName($name);

            if ($result) {
                $this->artistView->showSuccess($artist);
            } else {
                ErrorView::showError();
            }
        } else {
            $this->artistView->showArtistNotFound($name);
        }
    }
    public function updateArtist()
    {
        $artistId        = $_POST['id_artist'] ?? null; 
        $newName         = $_POST['name'] ?? null;      
        $newBiography    = $_POST['biography'] ?? null;
        $newCover        = $_FILES['cover'] ?? null;
        $newDateOfBirth  = $_POST['date_of_birth'] ?? null;
        $newDateOfDeath  = $_POST['date_of_death'] ?? null;
        $newPlaceOfBirth = $_POST['place_of_birth'] ?? null;

        if (empty($artistId) || !is_numeric($artistId) || (int)$artistId <= 0) {
            ErrorView::showError();
            return;
        }

        $artistId = (int)$artistId;

        $artistBeforeUpdate = $this->artistModel->getArtistById($artistId);
        if ($artistBeforeUpdate === null) {
            $this->artistView->showArtistNotFound($artistId);
            return;
        }

        $updated = false;

        if (!empty($newName)) {
            $updated = $this->artistModel->updateArtistName($artistId, $newName) || $updated;
        }

        if (!empty($newBiography)) {
            $updated = $this->artistModel->updateArtistBiography($artistId, $newBiography) || $updated;
        }

        $hasCover = $newCover && isset($newCover['name']) && $newCover['error'] === UPLOAD_ERR_OK;
        $coverPath = $hasCover
            ? FileUploader::handleCoverUpload($newCover, $newName ?? $artistBeforeUpdate->name, self::COVER_UPLOAD_DIR)
            : $artistBeforeUpdate->cover; 

        if ($hasCover && $coverPath === null) {
            ErrorView::coverUploadError();
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

        if ($updated) {
            $artistAfterUpdate = $this->artistModel->getArtistById($artistId);
            $this->artistView->showSuccess([$artistBeforeUpdate, $artistAfterUpdate]);
        } else {
            ErrorView::showError();
        }
    }
}
