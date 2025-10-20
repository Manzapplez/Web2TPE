<?php

require_once './app/models/UserModel.php';
require_once './app/helpers/FileUploader.php';
require_once './app/controllers/AuthController.php';
require_once './app/views/View.php';
require_once './app/views/ErrorView.php';

class UserController
{
    private UserModel $userModel;
    private AuthController $authController;
    private View $view;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->authController = new AuthController();
        $this->view = new View();
    }

    public function registerUser(): void
    {
        $name     = $_POST['userName'] ?? '';
        $email    = $_POST['userEmail'] ?? '';
        $password = $_POST['userPassword'] ?? '';
        $photo    = $_FILES['photoUser'] ?? null;

        if ($this->userModel->userNameExists($name)) {
            ErrorView::userAlreadyExists();
            return;
        }

        if ($this->userModel->emailExists($email)) {
            ErrorView::emailAlreadyExists();
            return;
        }

        $uploadDir   = "assets/img/covers/users/";
        $defaultPhoto = "/soundSnack/assets/img/covers/users/defaultUser.jpg";
        $photoPath    = $defaultPhoto;

        $hasPhoto = $photo && isset($photo['name']) && $photo['error'] === UPLOAD_ERR_OK;

        if ($hasPhoto) {
            $uploadedPath = FileUploader::handleCoverUpload($photo, $name, $uploadDir);
            if ($uploadedPath !== null) {
                $photoPath = $uploadedPath;
            } else {
                ErrorView::photoUploadError();
                return;
            }
        } else if ($photo && $photo['error'] !== UPLOAD_ERR_NO_FILE) {
            ErrorView::photoUploadError();
            return;
        }

        $result = $this->userModel->registerUser($name, $email, $password, $photoPath);
        $result ? $this->view->showSuccess() : ErrorView::showError();
    }

    public function getUserProfile(): void
    {
        $name = $_POST['userName'] ?? '';

        $user = $this->userModel->getUserByName($name);

        if ($user !== null) {
            $this->view->userProfile($user);
        } else {
            ErrorView::userNotFound();
        }
    }

    public function showHome(): void
    {
        $this->view->showHome();
    }

    public function showAdmin(): void
    {
        if ($this->authController->isAdmin()) {
            $this->view->showAdmin();
        } else {
            $this->view->showHome();
        }
    }

    public function showLogin(): void
    {
        $this->view->showLogin();
    }

    public function showRegister(): void
    {
        $this->view->showRegister();
    }
}
