<?php

namespace Models;

use PDO;
use Models\DBConnection;

class Comment extends DBConnection {

    protected $table = 'comments';
    protected $db;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    //Récupèrer les commentaires en BDD selon un post
    public function findCommentsByPostId(int $postId)
    {
        $stmt = $this->db->getPDO()->prepare("
            SELECT 
            comments.comment,
            DATE_FORMAT(comments.created_at, '%d/%m/%Y') AS formatted_created_at,
            comment_users.firstname AS comment_author_firstname,
            comment_users.lastname AS comment_author_lastname
        FROM 
            comments
        LEFT JOIN
            users AS comment_users ON comments.id_user = comment_users.id
        WHERE 
            comments.id_post = ?
        ORDER BY
            comments.created_at DESC;
        ");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $stmt->execute([$postId]);
        return $stmt->fetchAll();
    }

    // Supprimez les commentaires associés à un seul article.
    public function deleteCommentsForPost(int $postId)
    {
        return $this->query("DELETE FROM comments WHERE id_post = ?", $postId);
    }
}