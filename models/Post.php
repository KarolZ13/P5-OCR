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

    // Récupère tous les posts en BDD
    public function getPosts(): array
    {
        return $this->query("
            SELECT 
                posts.*,
                users.firstname AS author_firstname,
                users.lastname AS author_lastname,
                DATE_FORMAT(posts.created_at, '%d/%m/%Y') AS formatted_date
            FROM 
                {$this->table} AS posts
            LEFT JOIN
                users ON posts.id_user = users.id
            ORDER BY
                posts.created_at DESC
        ", null);
    }

    // Récupère un post en BDD selon l'id
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

    // Supression d'un post en BDD avec l'id
    public function deletePost(int $id): bool
    {
        return $this->query("DELETE FROM posts WHERE id = ?", $id);
    }


    // Mise à jour d'un post en BDD selon son id
    public function updatePost(int $id, array $data)
    {
        $sql = "UPDATE posts SET title = :title, chapo = :chapo, content = :content WHERE id = :id";
    
        $stmt = $this->db->getPDO()->prepare($sql);
    
        $stmt->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $stmt->bindValue(':chapo', $data['chapo'], PDO::PARAM_STR);
        $stmt->bindValue(':content', $data['content'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
}