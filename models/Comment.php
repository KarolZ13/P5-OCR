<?php

namespace Models;

use PDO;
use Models\DBConnection;

class Comment extends DBConnection 
{
    protected $table = 'comments';
    protected $db;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    /** Récupèrer les commentaires en BDD d'un post */
    public function getCommentsByPostId(int $postId)
    {
        $stmt = $this->db->getPDO()->prepare("
            SELECT 
            comments.id,
            comments.comment,
            comments.is_valid,
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

    /** Supprimer les commentaires associés à un seul article. */
    public function deleteCommentsForPost(int $postId)
    {
        return $this->query("DELETE FROM comments WHERE id_post = ?", $postId);
    }

    public function addComment(string $comment, int $isValid, int $userID, int $postID, string $createdAt)
    {
        $isValid = 0;

        $stmt = $this->db->getPDO()->prepare('INSERT INTO ' . $this->table . ' (comment, is_valid, id_user, id_post, created_at) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$comment, $isValid, $userID, $postID, $createdAt]);
        return $stmt->rowCount();
    }

    /** Désactiver les commentaires d'un utilisateur*/
    public function disableUserComments(int $userId)
    {
        return $this->query("UPDATE comments SET is_valid = 0 WHERE id_user = ?", $userId);
    }

    /** Changement de status (activé/désactivé) pour un commentaire */
    public function toggleCommentStatus(int $commentId, int $newStatus)
    {
        
        if ($newStatus == 0) {
            $stmt = $this->db->getPDO()->prepare("UPDATE comments SET is_valid = 1 WHERE id = :id");
        } else {
            $stmt = $this->db->getPDO()->prepare("UPDATE comments SET is_valid = 0 WHERE id = :id");
        }

        $stmt->bindParam(':id', $commentId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /** Récupération du status du commentaire (activé/désactivé) */
    public function getCommentStatus(int $commentId)
    {
        $stmt = $this->db->getPDO()->prepare("SELECT is_valid FROM comments WHERE id = :id");
        $stmt->bindParam(':id', $commentId, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    /** Suppression d'un commentaire */
    public function deleteComment(int $commentId)
    {
        return $this->query("DELETE FROM comments WHERE id = ?", $commentId);
    }
}