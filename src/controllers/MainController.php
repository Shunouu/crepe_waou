<?php

class MainController
{
    public function home()
    {
        require_once __DIR__ . '/../views/home.php';
    }

    public function login()
    {
        require_once __DIR__ . '/../views/login.php';
    }

    public function categories()
    {
        require_once __DIR__ . '/../views/categories.php';
    }

    public function cd()
    {
        require_once __DIR__ . '/../views/cd.php';
    }

    public function dvd()
    {
        require_once __DIR__ . '/../views/dvd.php';
    }

    public function accessoires()
    {
        require_once __DIR__ . '/../views/accessoires.php';
    }

    public function panier()
    {
        include_once __DIR__ . '/../views/panier.php';
    }

    public function afficherPanier()
    {
        include __DIR__ . '/../views/panier.php';
    
    }

    public function paiement()
    {
        require_once __DIR__ . '/../views/paiement.php';
    }

    public function formulaire()
    {
        require_once __DIR__ . '/../views/formulaire.php';
    }

    public function basededonnee()
    {
        require_once __DIR__ . '/../views/db.php';
    }

    public function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        require_once __DIR__ . '/../views/404.php';
        http_response_code(404);
        echo "<p>Désolé, la page que vous recherchez n'existe pas.</p>";
        exit;
    }
}