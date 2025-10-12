<?php

class AuthView extends View
{
    // muestra template del login
    public function showLogin($error = null)
    {
        require './app/templates/login.phtml';
    }
}
