<?php

// require_once './app/views/View.php';

class AuthView extends View
{
    public function showLogin($error = null)
    {
        require './app/templates/login.phtml';
    }
}
