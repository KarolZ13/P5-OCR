<?php

namespace Models;

use Models\DBConnection;
use PDO;

class User extends DBConnection
{

    protected $table = 'users';
    protected $db;


    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    /** Récupère les informations d'un utilisateur selon son email en BDD */
    public function getByEmail(string $email)
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM ' . $this->table . ' WHERE email = ?');
        $stmt->execute([$email]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $stmt->fetch();
    }

    public function getUser(int $userId)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", $userId, true);
    }

    /** Ajoute un utilisateur en BDD */
    public function addUser(string $lastname, string $firstname, string $email, string $password)
    {
        $existingUser = $this->getByEmail($email);

        if ($existingUser) {
            return -1;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->getPDO()->prepare('INSERT INTO ' . $this->table . ' (lastname, firstname, email, password, is_admin, is_enable) VALUES (?, ?, ?, ?, 0, 1)');
        $stmt->execute([$lastname, $firstname, $email, $hashedPassword]);
        return $stmt->rowCount();
    }

    /** Récupère toutes les informations des utilisateurs en BDD */
    public function getUsers(): array
    {
        return $this->query("SELECT * FROM users ORDER BY id DESC", null);
    }

    /** Récupère le nombre de commentaire créé par un utilisateur */
    public function getUsersWithCommentCounts(): array
    {
        return $this->query("SELECT u.id, u.firstname, u.lastname, u.email, u.is_admin, COUNT(c.id) as comment_count
                FROM users u
                LEFT JOIN comments c ON u.id = c.id_user
                GROUP BY u.id, u.firstname, u.lastname, u.email, u.is_admin", null);
    }

    /** Récupère le nombre d'article créé par un utilisateur */
    public function getUsersWithPostCounts(): array
    {
        return $this->query("SELECT u.id, u.firstname, u.lastname, u.email, u.is_admin, COUNT(p.id) as post_count
        FROM users u
        LEFT JOIN posts p ON u.id = p.id_user
        GROUP BY u.id, u.firstname, u.lastname, u.email, u.is_admin", null);
    }

    /** Changement du status de l'utilisateur (activé/désactivé) */
    public function setUserStatus(int $userId, int $isEnable)
    {

        if ($isEnable == 0) {
            $stmt = $this->db->getPDO()->prepare("UPDATE users SET is_enable = 1 WHERE id = :id");
        } else {
            $stmt = $this->db->getPDO()->prepare("UPDATE users SET is_enable = 0 WHERE id = :id");
        }

        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /** Récupération du status d'un utilisateur */
    public function getUserStatus(int $userId)
    {
        $stmt = $this->db->getPDO()->prepare("SELECT is_enable FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    /** Modification du profil d'un utilisateur */
    public function setUserProfil(int $userId, array $data)
    {
        $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, avatar = :avatar";

        if (!empty($data['password'])) {
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            $sql .= ", password = :password";
        }

        $sql .= " WHERE id = :id";

        $stmt = $this->db->getPDO()->prepare($sql);

        $stmt->bindValue(':firstname', $data['firstname'], PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $data['lastname'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':avatar', $data['avatar'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $userId, PDO::PARAM_INT);

        if (!empty($data['password'])) {
            $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        }

        return $stmt->execute();
    }

    /** Suppression de l'utilisateur et de ses commentaires */
    public function deleteUserAndComments(int $userId)
    {
        $this->db->getPDO()->beginTransaction();

        $this->query("DELETE FROM comments WHERE id_user = ?", $userId);

        $this->query("DELETE FROM users WHERE id = ?", $userId);

        $this->db->getPDO()->commit();

        return true;
    }

    /** Mettre le status d'un utilisateur en administrateur */
    public function setUserAdmin(int $userId)
    {
        $stmt = $this->db->getPDO()->prepare("UPDATE users SET is_admin = 1 WHERE id = :id");

        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}