<?php

namespace src\controllers;

use Models\DBConnection;
use Models\User;

class MainController
{

    protected $db;

    public function __construct(DBConnection $db)
    {
        if (session_start() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->db = $db;
    }

    /**Récupération de la vue utilisateur avec le layout */
    protected function view(string $path, array $params = null)
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }

    /**Récupération de la vue administrateur avec le layout */
    protected function adminView(string $path, array $params = null)
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        $content = ob_get_clean();
        require VIEWS . 'layout-admin.php';
    }

    /**Récupération de la connexion à la BDD */
    protected function getDB()
    {
        return $this->db;
    }

    /**Vue de la page d'accueil */
    public function homepage()
    {
        return $this->view('blog.home-page');
    }

    /** Vérifie si l'utilisateur et administrateur */
    protected function isAdmin()
    {
        if (isset($_SESSION['auth']) && $_SESSION['auth']['is_admin'] === 1) {
            return true;
        } else {
            return header('Location: /p5-ocr/login');
        }
    }

    /** Récupération des informations pour la vue de la page d'accueil administrateur */
    public function homepageAdmin()
    {
        $this->isAdmin();

        $user = new User($this->getDB());
        $users = $user->getUsers();
        $usersWithCommentCounts = $user->getUsersWithCommentCounts();
        $usersWithPostCounts = $user->getUsersWithPostCounts();

        return $this->adminView('admin.homepage-admin', compact('users', 'usersWithCommentCounts', 'usersWithPostCounts'));
    }

    public function redirectWithMessage($url, $message)
    {
        header("Location: $url?$message");
        exit;
    }
}