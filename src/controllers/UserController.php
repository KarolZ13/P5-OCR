<?php

namespace src\controllers;

use Models\Post;
use Models\User;
use Models\Comment;

class UserController extends MainController
{


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
                'avatar' => $user->avatar,
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

        // Valider que tous les champs sont remplis
        if (empty($lastname) || empty($firstname) || empty($email) || empty($password)) {
            return header('Location: /p5-ocr/signin?error=missing_fields');
        }

        // Valider l'adresse e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strpos($email, '@') === false) {
            return header('Location: /p5-ocr/signin?error=invalid_email');
        }

        // Valider le mot de passe
        if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9\W]/', $password)) {
            return header('Location: /p5-ocr/signin?error=invalid_password');
        }

        $userModel = new User($this->getDB());

        $result = $userModel->addUser($lastname, $firstname, $email, $password);

        if ($result === 1) {
            return header('Location: /p5-ocr/login?success=true');
        } elseif ($result === -1) {
            return header('Location: /p5-ocr/signin?error=email_taken');
        } else {
            return header('Location: /p5-ocr/signin');
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
    public function editUserProfil(int $userId)
    {
        $user = (new User($this->getDB()))->getUser($userId);
        $user = $user->getUser($userId);

        return $this->view('blog.profil-edit', compact('user'));
    }

    /** Changement de status d'un utilisateur (activé/désactivé) */
    public function toggleUser(int $userId)
    {
        $this->isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($this->getDB());
            $currentIsEnable = $user->getUserStatus($userId);
            $isEnable = $currentIsEnable;
            $result = $user->setUserStatus($userId, $isEnable);

            if ($result) {
                header('Location: /p5-ocr/admin/users?success=true');
            } else {
                header('Location: /p5-ocr/admin/users?error=true');
            }
        }
    }

    /** Affiche la page d'édition d'un profil dans l'espace administrateur */
    public function adminEditUserProfil(int $userId)
    {
        $this->isAdmin();

        $user = (new User($this->getDB()))->getUser($userId);
        $user = $user->getUser($userId);

        return $this->adminView('admin.user-edit', compact('user'));
    }

    /** Récupération des informations mise à jour pour le profil d'un utilisateur dans l'espace administrateur */
    public function adminUpdateUserProfil(int $userId)
    {
        $this->isAdmin();

        $userModel = (new User($this->getDB()))->getUser($userId);
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

        $result = $userModel->setUserProfil($userId, $userData);

        if ($result) {
            return header("Location: /p5-ocr/admin/users?success=true");
        } else {
            echo "Erreur lors de la modification";
        }
    }


    /** Suppression d'un utilisateur dans l'espace administrateur */
    public function deleteUser(int $userId)
    {
        $this->isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User($this->getDB());
            $result = $userModel->deleteUserAndComments($userId);

            if ($result) {
                header('Location: /p5-ocr/admin/users?delete_success=true');
            } else {
                header('Location: /p5-ocr/admin/users?error=true');
            }
        }
    }

    /** Modification de l'utilisateur en administrateur */
    public function setUserAdmin(int $userId)
    {
        $this->isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User($this->getDB());
            $result = $userModel->setUserAdmin($userId);

            if ($result) {
                header('Location: /p5-ocr/admin/users?success=true');
            } else {
                header('Location: /p5-ocr/admin/users?error=true');
            }
        }
    }

    /** Mise à jour du profil d'un utilisateur */
    public function updateUserProfil(int $userId)
    {
        if (!$userId) {
            return header("Location: /p5-ocr/error");
        }

        $userModel = (new User($this->getDB()))->getUser($userId);
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

        $result = $userModel->setUserProfil($userId, $userData);

        if ($result) {
            return header("Location: /p5-ocr/profil/{$userId}?success=true");
        } else {
            echo "Erreur lors de la modification";
        }
    }
}