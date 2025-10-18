<?php

require_once './app/models/UserModel.php';
require_once './app/views/View.php';
require_once './app/views/ErrorView.php';
require_once './app/helpers/FileUploader.php';

class UserController
{
    private UserModel $userModel;
    private View $view;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->view = new View();
    }

    public function registerUser(): void
    {
        $name     = $_POST['userName'] ?? '';
        $email    = $_POST['userEmail'] ?? '';
        $password = $_POST['userPassword'] ?? '';
        $photo    = $_FILES['photoUser'] ?? null;

        if ($this->userModel->userNameExists($name)) {
            $this->view->showUserAlreadyExists($name);
            return;
        }

        if ($this->userModel->emailExists($email)) {
            $this->view->showEmailAlreadyExists($email);
            return;
        }

        $uploaded = false;

        $photoPath = "files/img/perfil.jpg";
        $uploadDir = "assets/img/covers/users/";

        $hasPhoto = $photo && isset($photo['name']) && $photo['error'] === UPLOAD_ERR_OK;

        if ($hasPhoto) {
            $uploadedPath = FileUploader::handleCoverUpload($photo, $name, $uploadDir);
            if ($uploadedPath !== null) {
                $photoPath = $uploadedPath;
                $uploaded = true;
            } else {
                ErrorView::showPhotoUploadError();
                return;
            }
        } else if ($photo && $photo['error'] !== UPLOAD_ERR_NO_FILE) {
            ErrorView::showPhotoUploadError();
            return;
        } else {
            $uploaded = true;
        }

        if ($uploaded) {
            $result = $this->userModel->registerUser($name, $email, $password, $photoPath);
            $result ? $this->view->showSuccess() : ErrorView::showError();
        }
    }

    public function loginUser(): void
    {
        $name     = $_POST['userName'] ?? '';
        $password = $_POST['userPassword'] ?? '';

        $user = $this->userModel->getUserByName($name);

        if (!$user || !$this->userModel->verifyPassword($name, $password)) {
            ErrorView::showInvalidCredentials();
            return;
        }

        $_SESSION['user'] = [
            'id_user'       => $user->id_user,
            'name'          => $user->name,
            'email'         => $user->email,
            'profile_photo' => $user->profile_photo
        ];

        $this->view->showLoginSuccess();
    }

    public function getUserProfile(): void
    {
        $name = $_POST['userName'] ?? '';

        $user = $this->userModel->getUserByName($name);

        if ($user !== null) {
            $this->view->showUserProfile($user);
        } else {
            ErrorView::showUserNotFound();
        }
    }

    public function showHome(): void
    {
        //si tiene una seccion activa entonces el template se actualiza de distinta forma
        $this->view->showHome();
    }

    public function showLogin(): void
    {
        // si tiene una session activa no puede llamar a este metodo, automaticamente se va al home donde tiene el boton de cerrar session
        $this->view->showLogin();
    }

    public function showRegister(): void
    {
        $this->view->showRegister();
    }
}
