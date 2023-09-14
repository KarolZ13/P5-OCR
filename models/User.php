<?php

namespace Models;

use Models\DBConnection;
use PDO;

class User extends DBConnection {

    protected $table = 'users';
    protected $db;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    public function getByEmail(string $email)
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM ' . $this->table . ' WHERE email = ?');
        $stmt->execute([$email]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $stmt->fetch();
    }

        public function addUser(string $lastname, string $firstname, string $email, string $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->getPDO()->prepare('INSERT INTO ' . $this->table . ' (lastname, firstname, email, password, is_admin, is_enable) VALUES (?, ?, ?, ?, 0, 1)');
        $stmt->execute([$lastname, $firstname, $email, $hashedPassword]);
        // Vous pouvez également gérer les erreurs ici si nécessaire
        return $stmt->rowCount(); // Renvoie le nombre de lignes affectées (1 si l'insertion réussit)
    }

    public function getUserData(string $email)
    {
        return $this->query("SELECT * FROM users WHERE email = ?", $email, true);
    }

    public function getUsers(): array
    {
        return $this->query("SELECT * FROM users", null);
    }

    public function getUsersWithCommentCounts(): array
    {
        return $this->query("SELECT u.id, u.firstname, u.lastname, u.email, u.is_admin, COUNT(c.id) as comment_count
                FROM users u
                LEFT JOIN comments c ON u.id = c.id_user
                GROUP BY u.id, u.firstname, u.lastname, u.email, u.is_admin", null);
    }

    public function getUsersWithPostCounts(): array
    {
        return $this->query("SELECT u.id, u.firstname, u.lastname, u.email, u.is_admin, COUNT(p.id) as post_count
        FROM users u
        LEFT JOIN posts p ON u.id = p.id_user
        GROUP BY u.id, u.firstname, u.lastname, u.email, u.is_admin", null);
    }
}