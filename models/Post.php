<?php

namespace Models;

use PDO;
use Models\DBConnection;

class Post extends DBConnection
{
    protected $table = 'posts';
    protected $db;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    /** Récupère tous les articles **/
    public function getPosts(): array
    {
        return $this->query("
            SELECT 
                posts.*,
                users.firstname AS author_firstname,
                users.lastname AS author_lastname,
                DATE_FORMAT(posts.created_at, '%d/%m/%Y') AS formatted_date,
                categories.name AS category_name
            FROM 
                {$this->table} AS posts
            LEFT JOIN
                users ON posts.id_user = users.id
            LEFT JOIN
                categories ON posts.id_categories = categories.id
            ORDER BY
                posts.created_at DESC
        ", null);
    }

    /** Récupère un article selon l'id **/
    public function getPost(int $id)
    {
        return $this->query("
            SELECT 
                posts.*,
                users.firstname,
                users.lastname,
                DATE_FORMAT(posts.created_at, '%d/%m/%Y') AS formatted_created_at,
                DATE_FORMAT(posts.updated_at, '%d/%m/%Y') AS formatted_updated_at,
                categories.name AS category_name,
                categories.id AS id_categories
            FROM 
                {$this->table} AS posts
            LEFT JOIN 
                users ON posts.id_user = users.id
            LEFT JOIN
                categories ON posts.id_categories = categories.id
            WHERE 
                posts.id = ?
            ", $id, true);
    }
    
    /** Récupére les catégories **/
    public function getCategories()
    {
        return $this->query("SELECT * FROM categories");
    }

    /** Supression d'un article selon l'id **/
    public function deletePost(int $id): bool
    {
        return $this->query("DELETE FROM posts WHERE id = ?", $id);
    }


    /** Changement de status d'un article (activé/désactivé) **/
    public function togglePostStatus(int $id, int $newStatus)
    {
        
        if ($newStatus == 0) {
            $stmt = $this->db->getPDO()->prepare("UPDATE posts SET status = 1 WHERE id = :id");
        } else {
            $stmt = $this->db->getPDO()->prepare("UPDATE posts SET status = 0 WHERE id = :id");
        }

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /** Récupére le status de chaque articles **/
    public function getPostStatus(int $id)
    {
        $stmt = $this->db->getPDO()->prepare("SELECT status FROM posts WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_COLUMN);
    }


    /** Mise à jour d'un article selon son id **/
    public function updatePost(int $id, array $data)
    {
        $sql = "UPDATE posts SET title = :title, chapo = :chapo, content = :content, picture = :picture, id_categories = :id_categories WHERE id = :id";
    
        $stmt = $this->db->getPDO()->prepare($sql);
    
        $stmt->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $stmt->bindValue(':chapo', $data['chapo'], PDO::PARAM_STR);
        $stmt->bindValue(':content', $data['content'], PDO::PARAM_STR);
        $stmt->bindValue(':id_categories', $data['id_categories'], PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':picture', $data['picture'], PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    /** Ajouter un article **/
    public function addPost(string $title, string $content, string $chapo, ?string $picture, int $status, int $userId, int $id_categories, string $createdAt)
    {
        $stmt = $this->db->getPDO()->prepare('INSERT INTO ' . $this->table . ' (title, content, chapo, picture, status, id_user, id_categories, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$title, $content, $chapo, $picture, $status, $userId, $id_categories, $createdAt]);
        return $stmt->rowCount();
    }

    /** Désactiver un article selon l'id de l'utilisateur **/
    public function disableUserPosts(int $userId)
    {
        return $this->query("UPDATE posts SET status = 0 WHERE id_user = ?", $userId);
    }
}