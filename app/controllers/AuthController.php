<?php
require_once './app/models/UserModel.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function logInUser()
    {
        $userName = $_POST["userName"];
        $userPassword = $_POST["userPassword"];

        if ($this->userModel->userNameExists($userName)) {
            if ($this->userModel->verifyPassword($userName, $userPassword)) {
                $user = $this->userModel->getUserByName($userName);

                $_SESSION['user'] = [
                    'id' => $user->id_user,
                    'name' => $user->name,
                    'email' => $user->email,
                    'profilePhoto' => $user->profile_photo,
                    'loggedIn' => true
                ];
                // Redirige según el tipo de usuario
                $this->redirectUser();
            } else {
                ErrorView::failedLogin();
            }
        } else {
            ErrorView::failedLogin();
        }
    }

    public function logOut(): void
    {
        $_SESSION = [];
        session_destroy();
        header("Location: home");
        exit;
    }
    // Retorna true si hay sesión activa y el usuario está logueado
    public function isSessionActive(): bool
    {
        return isset($_SESSION['user']) && !empty($_SESSION['user']['loggedIn']);
    }

    // Retorna true si la sesión está activa y el usuario es admin
    public function isAdmin(): bool
    {
        return $this->isSessionActive() && isset($_SESSION['user']['name']) && $_SESSION['user']['name'] === 'webadmin';
    }

    // Redirige según el tipo de usuario o si no hay sesión activa
    public function redirectUser(): void
    {
        if ($this->isSessionActive()) {
            if ($this->isAdmin()) {
                header("Location: admin");
                exit;
            } else {
                header("Location: home");
                exit;
            }
        } else {
            header("Location: home");
            exit;
        }
    }
}
