<?php
require_once __DIR__ . '/../../views/viewHome/ViewHome.php';

class ControlHome
{
    private ViewHome $viewHome;

    public function __construct()
    {
        $this->viewHome = new ViewHome();
    }

    public function showHome(): void
    {
        $this->viewHome->showHome();
    }

    public function showLogin(): void
    {
        $this->viewHome->showLogin();
    }
}
