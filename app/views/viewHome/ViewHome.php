<?php
final class ViewHome
{
    public function showHome()
    {
        require_once __DIR__ . '/../templates/templatesHome/header.phtml';
        require_once __DIR__ . '/../templates/templatesHome/nav.phtml';
        require_once __DIR__ . '/../templates/templatesHome/article.phtml';
        require_once __DIR__ . '/../templates/templatesHome/footer.phtml';
    }

    public function showLogin(): void
    {
        require_once __DIR__ . '/../templates/templatesHome/header.phtml';
        require_once __DIR__ . '/../templates/templatesHome/nav.phtml';
        require_once __DIR__ . '/../templates/templatesUser/login.phtml'; 
        require_once __DIR__ . '/../templates/templatesHome/footer.phtml';
    }

    
    public function showRegister(): void
    {
        require_once __DIR__ . '/../templates/templatesHome/header.phtml';
        require_once __DIR__ . '/../templates/templatesHome/nav.phtml';
        require_once __DIR__ . '/../templates/templatesUser/register.phtml'; 
        require_once __DIR__ . '/../templates/templatesHome/footer.phtml';
    }
}
