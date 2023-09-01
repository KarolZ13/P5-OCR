<?php

namespace Models;

use Models\DBConnection;
use PDO;

class User {

    protected $table = 'users';
    protected $db;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    public function getByEmail(string $email)
    {
        $stmt = $this->db->getPDO()->query('SELECT * FROM {$this->table} WHERE email = ?', [$email], true);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $stmt->fetchAll();
    }
}