<?php

namespace src\controllers;

use Models\Post;
use Models\User;
use Models\Comment;

class UserController extends MainController {

    /** Affiche la vue de connexion */
    public function login() 
    {
        return $this->view('blog.login');
    }

    /** Récupére les informations soumis par l'utilisateur lors de la connexion */
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
    
    /** Déconnexion de l'utilisateur */
    public function logout()
    {
        session_destroy();

        return header('Location: /p5-ocr/');
    }

    /** Récupére les informations d'inscription pour ajouter un utilisateur */
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
        } elseif ($result === -1) {
            return header('Location: /p5-ocr/signin?error=email_taken');
        } else {
            return header ('Location: /p5-ocr/signin');
        }
    }
    

    /** Affiche la page d'inscription' */
    public function signIn()
    {
    return $this->view('blog.signin');
    }

    /** Récupére les informations des utilisateurs pour la mettre dans la vue administrateur */
    public function getUsers()
    {
        $this->isAdmin();
        
        $user = new User($this->getDB());
        $users = $user->getUsers();

        return $this->adminView('admin.users-admin', compact('users'));
        return $this->view('layout', compact('users'));
    }

    /** Affiche la page de modification d'un profil */
    public function editUserProfil(int $id)
    {
        $user = (new User($this->getDB()))->getUser($id);
        $user = $user->getUser($id);
        
        return $this->view('blog.profil-edit', compact('user'));
    }

    /** Changement de status d'un utilisateur (activé/désactivé) */
    public function toggleUser(int $id)
    {
        $this->isAdmin();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($this->getDB());
            $currentIsEnable = $user->getUserStatus($id);
            $isEnable = $currentIsEnable;
            $result = $user->setUserStatus($id, $isEnable);

            if ($result) {
                header('Location: /p5-ocr/admin/users?success=true');
            } else {
                header('Location: /p5-ocr/admin/users?error=true');
            }
        }
    }

    /** Affiche la page d'édition d'un profil dans l'espace administrateur */
    public function adminEditUserProfil(int $id)
    {
        $this->isAdmin();

        $user = (new User($this->getDB()))->getUser($id);
        $user = $user->getUser($id);
        
        return $this->adminView('admin.user-edit', compact('user'));
    }
    
    /** Récupération des informations mise à jour pour le profil d'un utilisateur dans l'espace administrateur */
    public function adminUpdateUserProfil(int $id)
    {
        $this->isAdmin();
    
        $userModel = (new User($this->getDB()))->getUser($id);
        $userData = $_POST;
    
        if (empty($userData['password'])) {
            unset($userData['password']);
        }
    
        if (isset($_FILES['new_avatar']) && $_FILES['new_avatar']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '/p5-ocr/public/assets/img/';
            $newAvatarFileName = $_FILES['new_avatar']['name'];
            $uploadPath = $uploadDir . $newAvatarFileName;
    
            if (!empty($userModel->avatar)) {
                unlink($uploadDir . $userModel->avatar);
            }
    
            move_uploaded_file($_FILES['new_avatar']['tmp_name'], $uploadPath);
            $userData['avatar'] = $newAvatarFileName;
        } else {
            $userData['avatar'] = $userModel->avatar;
        }
    
        $result = $userModel->setUserProfil($id, $userData);
    
        if ($result) {
            return header("Location: /p5-ocr/admin/users?success=true");
        } else {
            echo "Erreur lors de la modification";
        }
    }
    
    
    /** Suppression d'un utilisateur dans l'espace administrateur */
    public function deleteUser(int $id)
    {
        $this->isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User($this->getDB());
            $result = $userModel->deleteUserAndComments($id);

            if ($result) {
                header('Location: /p5-ocr/admin/users?success=true');
            } else {
                header('Location: /p5-ocr/admin/users?error=true');
            }
        }
    }

    /** Modification de l'utilisateur en administrateur */
    public function setUserAdmin(int $id)
    {
        $this->isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User($this->getDB());
            $result = $userModel->setUserAdmin($id);

            if ($result) {
                header('Location: /p5-ocr/admin/users?success=true');
            } else {
                header('Location: /p5-ocr/admin/users?error=true');
            }
        }
    }

    /** Mise à jour du profil d'un utilisateur */
    public function updateUserProfil(int $id)
    {
        if (!$id) {
            return header("Location: /p5-ocr/error");
        }

        $userModel = (new User($this->getDB()))->getUser($id);
        $userData = $_POST;
    
        if (empty($userData['password'])) {
            unset($userData['password']);
        }
    
        if (isset($_FILES['new_avatar']) && $_FILES['new_avatar']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '/p5-ocr/public/assets/img/';
            $newAvatarFileName = $_FILES['new_avatar']['name'];
            $uploadPath = $uploadDir . $newAvatarFileName;
    
            if (!empty($userModel->avatar)) {
                unlink($uploadDir . $userModel->avatar);
            }
    
            move_uploaded_file($_FILES['new_avatar']['tmp_name'], $uploadPath);
            $userData['avatar'] = $newAvatarFileName;
        } else {
            $userData['avatar'] = $userModel->avatar;
        }
    
        $result = $userModel->setUserProfil($id, $userData);
    
        if ($result) {
            return header("Location: /p5-ocr/profil/{$id}?success=true");
        } else {
            echo "Erreur lors de la modification";
        }
    }
}