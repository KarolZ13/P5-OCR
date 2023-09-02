<?php

namespace src\controllers;

use Models\DBConnection;

class MainController {

    protected $db;

    public function __construct(DBConnection $db)
    {
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
}