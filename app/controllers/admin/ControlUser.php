<?php

class UserControl
{

    public function registerUser()
    {
        $userName = $_POST["userName"];
        $userEmail = $_POST["userEmail"];
        $userPassword = $_POST["userPassword"];
        $filePath = "";
        $failedEmail = false;
        $failedUserName = false;


        if ($this->userNameCorrect($userName)) {
            if ($this->userEmailCorrect($userEmail)) {

                if (!isset($_FILES['photoUser']['type'])) {
                    if ($_FILES['photoUser']['type'] == "image/jpg" || $_FILES['photoUser']['type'] == "image/jpeg" || $_FILES['photoUser']['type'] == "image/png") {
                        $filePath = "files/img/" . uniqid("", true) . "." . strtolower(pathinfo($_FILES['photoUser']['name'], PATHINFO_EXTENSION));
                        move_uploaded_file($_FILES['photoUser']['tmp_name'], $filePath);
                    } else {
                        echo "foto incorrecta";
                    }
                }

                if ($filePath === "") {
                    $filePath = "files/img/perfil.jpg";
                }

                $this->modelUser->successfulRegistration($userName, $userEmail, $userPassword, $filePath);
                $this->newUser();
            } else {
                $failedEmail = false;
                $failedUserName = true;
                $this->failedRegistrarion($failedEmail, $failedUserName);
            }
        } else {
            $failedEmail = true;
            $failedUserName = false;
            $this->failedRegistrarion($failedEmail, $failedUserName);
        }
    }
}
