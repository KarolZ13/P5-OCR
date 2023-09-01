<?php

namespace Models;

use PDO;
use Models\DBConnection;

class Post extends DBConnection {

    protected $table = 'posts';
    protected $db;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    public function getPosts(): array
    {
        return $this->query("SELECT *, DATE_FORMAT(created_at, '%d/%m/%Y') AS formatted_date FROM {$this->table} ORDER BY created_at DESC", null);
    }

    public function getPost(int $id)
    {
        return $this->query("
            SELECT 
            posts.*,
            users.firstname,
            users.lastname,
            DATE_FORMAT(posts.created_at, '%d/%m/%Y') AS formatted_created_at,
            DATE_FORMAT(posts.updated_at, '%d/%m/%Y') AS formatted_updated_at
        FROM 
            {$this->table} AS posts
        JOIN 
            users ON posts.id_user = users.id
        WHERE 
            posts.id = ?
        ", $id, true);
    }

    public function deletePost(int $id): bool
    {
        return $this->query("DELETE FROM posts WHERE id = ?", $id);
    }

    public function updatePost(int $id, array $data)
    {
        // Créez la requête SQL pour mettre à jour les informations de l'article
        $sql = "UPDATE posts SET title = :title, chapo = :chapo, content = :content WHERE id = :id";
    
        // Préparez la requête
        $stmt = $this->db->getPDO()->prepare($sql);
    
        // Associez les valeurs aux paramètres de la requête
        $stmt->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $stmt->bindValue(':chapo', $data['chapo'], PDO::PARAM_STR);
        $stmt->bindValue(':content', $data['content'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
        // Exécutez la requête
        return $stmt->execute();
    }
}