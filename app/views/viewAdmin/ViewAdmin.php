<?php
final class ViewAdmin
{
    public function __construct() {}

    public function showError(): void
    {
        require_once __DIR__ . '/../templates/templatesAdmin/headerAdmin.phtml';
        require_once __DIR__ . '/../templates/templatesAdmin/sectionArtist.phtml';
        require_once __DIR__ . '/../templates/messages/error.phtml';
        require_once __DIR__ . '/../templates/templatesHome/footer.phtml';
    }

    public function showSuccess(): void
    {
        require_once __DIR__ . '/../templates/templatesAdmin/headerAdmin.phtml';
        require_once __DIR__ . '/../templates/templatesAdmin/sectionArtist.phtml';
        require_once __DIR__ . '/../templates/messages/success.phtml';
        require_once __DIR__ . '/../templates/templatesHome/footer.phtml';
    }

    public function showArtistId(int $id): void
    {
        // firma vacía
    }

    public function showArtistCount(int $count): void
    {
        // firma vacía
    }

    public function showAllArtists(array $artists): void
    {
        // firma vacía
    }

    public function showArtist(object $artist): void
    {
        // firma vacía
    }

    public function showArtistAlreadyExists(string $name): void
    {
        // firma vacía
    }

    public function showArtistNotFound(string $name): void
    {
        // firma vacía
    }

    public function showAdmin(): void
    {
        require_once __DIR__ . '/../templates/templatesHome/header.phtml';
        require_once __DIR__ . '/../templates/templatesAdmin/artAdmin.phtml';
        require_once __DIR__ . '/../templates/templatesAdmin/sectionArtist.phtml';
        require_once __DIR__ . '/../templates/templatesHome/footer.phtml';
    }
}
