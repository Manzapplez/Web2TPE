<?php

class AuthHelper
{

    public static function init()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function login($user)
    {
        self::init();
        $_SESSION['USER_ID'] = $user->id_user;
        $_SESSION['USER_NAME'] = $user->username;
        $_SESSION['USER_PASSWORD'] = $user->password;
    }

    public static function logout()
    {
        self::init();
        $_SESSION = []; // limpia variables
        session_destroy();
    }

    // si no hay sesion activa redirige al login
    public static function verify()
    {
        self::init();
        if (!isset($_SESSION['USER_ID'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    }

    public static function check()
    {
        self::init();
        return isset($_SESSION['USER_ID']);
    }

    /*
    <?php

class AuthHelper
{
    public function isLoggedIn(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']['loggedIn'] === true;
    }
}
*/
}