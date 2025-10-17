<?php

class AuthHelper
{
    public function isLoggedIn(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']['loggedIn'] === true;
    }
}
