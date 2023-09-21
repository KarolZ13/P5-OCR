<?php

namespace src\controllers;

use Models\User;

class UserController extends MainController {

    // Affiche la vue de connexion
    public function login() 
    {
        return $this->view('blog.login');
    }

    // Récupére les informations soumis par l'utilisateur lors de la connexion
    public function loginPost() 
    {
        $email = $_POST['email'];
        $user = (new User($this->getDB()))->getByEmail($email);
    
        if (password_verify($_POST['password'], $user->password)) {
            $userData = [
                'is_admin' => $user->is_admin,
                'id' => $user->id,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
            ];
    
            $_SESSION['auth'] = $userData;
    
            if ($_SESSION['auth']['is_admin']) {
                return header('Location: /P5-OCR/admin?success=true');
            } else {
                return header('Location: /p5-ocr?success=true');
            }
        } else {
            return header('Location: /p5-ocr/login?error=true');
        }
    }
    
    // Déconnexion de l'utilisateur
    public function logout()
    {
        session_destroy();

        return header('Location: /p5-ocr/');
    }

    // Récupére les informations d'inscription pour ajouter un utilisateur
    public function signInPost()
    {
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $userModel = new User($this->getDB());
    
        $result = $userModel->addUser($lastname, $firstname, $email, $password);
    
        if ($result === 1) {
            return header('Location: /p5-ocr/login?success=true');
        } else {
            return header ('Location: /p5-ocr/signin');
        }
    }

    // Affiche la page d'inscription'
    public function signIn()
    {
    return $this->view('blog.signin');
    }

    // Récupére les informations des utilisateurs pour la mettre dans la vue administrateur des utilisateurs
    public function getUsers()
    {
        $user = new User($this->getDB());
        $users = $user->getUsers();

        return $this->adminView('admin.users-admin', compact('users'));
    }

    public function editUserProfil(int $id)
    {
        $user = (new User($this->getDB()))->getUser($id);
        $user = $user->getUser($id);
        
        return $this->view('blog.profil-edit', compact('user'));
    }
}