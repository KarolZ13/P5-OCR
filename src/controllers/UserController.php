<?php

namespace src\controllers;

use Models\User;

class UserController extends MainController {

    public function login() 
    {
        return $this->view('blog.login');
    }

    public function loginPost() 
    {
        $email = $_POST['email'];
        $user = (new User($this->getDB()))->getByEmail($email);
    
        if (password_verify($_POST['password'], $user->password)) {
            // Créez un tableau associatif pour stocker les informations de l'utilisateur
            $userData = [
                'is_admin' => $user->is_admin,
                'id' => $user->id, // Ajoutez d'autres informations que vous souhaitez stocker
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                // Ajoutez d'autres informations de l'utilisateur ici
            ];
    
            $_SESSION['auth'] = $userData;
    
            if ($_SESSION['auth']['is_admin']) {
                // Rediriger l'administrateur vers la page d'accueil de l'administrateur
                return header('Location: /P5-OCR/admin?success=true');
            } else {
                // Rediriger les utilisateurs non administrateurs vers une autre page
                return header('Location: /p5-ocr?success=true');
            }
        } else {
            return header('Location: /p5-ocr/login?error=true');
        }
    }
    

    public function logout()
    {
        session_destroy();

        return header('Location: /p5-ocr/');
    }

    public function signInPost()
    {
        // Récupérer les données du formulaire
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Créer une instance du modèle User
        $userModel = new User($this->getDB());
    
        // Appeler la méthode addUser pour ajouter l'utilisateur
        $result = $userModel->addUser($lastname, $firstname, $email, $password);
    
        if ($result === 1) {
            // L'utilisateur a été ajouté avec succès, vous pouvez rediriger l'utilisateur vers une page de confirmation
            // ou effectuer d'autres actions nécessaires.
            // Par exemple, vous pouvez rediriger l'utilisateur vers une page de connexion.
            return header('Location: /p5-ocr/login?success=true');
        } else {
            // Gérer les erreurs si l'ajout a échoué
            return header ('Location: /p5-ocr/signin');
        }
    }

    public function signIn()
    {
    return $this->view('blog.signin');
    }

    public function getUsers()
    {
        $user = new User($this->getDB());
        $users = $user->getUsers();

        return $this->adminView('admin.users-admin', compact('users'));
    }
}