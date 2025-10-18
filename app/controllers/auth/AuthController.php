<?php
require_once __DIR__ . '/../views/ControlError.php';
require_once __DIR__ . '/../../models/home/UserModel.php';

class AuthController
{
    private $userModel;
    private $error;

    public function __construct()
    {
        $this->error = new ControlError();
        $this->userModel = new UserModel();
    }

    public function logInUser()
{
    $userName = $_POST["userName"];
    $userPassword = $_POST["userPassword"];

    if ($this->userModel->userNameCorrect($userName)) {
        if ($this->userModel->passwordVerify($userName, $userPassword)) {

            $user = $this->userModel->getUserByName($userName);

            $_SESSION['user'] = [
                'id' => $user->id_user,
                'name' => $user->name,
                'email' => $user->email,
                'profilePhoto' => $user->profile_photo,
                'loggedIn' => true
            ];

           /* header('Location: /soundSnack/public/home');
            exit;*/

        } else {
            $this->error->failedLogin();
        }
    } else {
        $this->error->failedLogin();
    }
}

    /*
    public function logout()
    {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);
        exit;
    }*/
}
