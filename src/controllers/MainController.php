<?php

namespace src\controllers;

use Models\DBConnection;

class MainController {

    protected $db;

    public function __construct(DBConnection $db)
    {
        if (session_start() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->db = $db;
    }

    //Récupération de la vue avec le layout
    protected function view(string $path, array $params = null)
    {
    ob_start();
    $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
    require VIEWS . $path . '.php';
    $content = ob_get_clean();
    require VIEWS . 'layout.php';
    }

    //Récupération de la vue avec le layout
    protected function adminView(string $path, array $params = null)
    {
    ob_start();
    $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
    require VIEWS . $path . '.php';
    $content = ob_get_clean();
    require VIEWS . 'layout-admin.php';
    }

    //Récupération de la connexion à la BDD
    protected function getDB() 
    {
        return $this->db;
    }

    //Vue de la page d'accueil
    public function homepage()
    {
        return $this->view('blog.home-page');
    }

    protected function isAdmin()
    {
        if (isset($_SESSION['auth']) && $_SESSION['auth'] === 1 ) {
            return true;
        } else {
            return header('Location: /p5-ocr/login');
        }
    }
}