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
}